<?php

namespace App\Http\Controllers; 

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class OwnerDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Kartu Ringkasan (Top Metrics)
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('utype', 'USR')->count(); // Hanya menghitung user biasa
        
        // Pendapatan Bulan Ini (dari order status "selesai")
        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'selesai') // Pastikan status di DB cocok
            ->sum('total_amount');

        // 3. Produk Stok Rendah
        $lowStockProducts = Product::with('category') // Eager load category
            ->where('stock', '<', 5)
            ->orderBy('stock', 'asc')
            ->take(5) // Batasi jumlah yang ditampilkan di dashboard
            ->get();

        // 4. Tabel Order Terbaru
        $recentOrders = Order::with('user') // Eager load user
            ->latest() // Order terbaru
            ->take(10) // Maksimum 10 order
            ->get();

        // Data untuk Grafik Penjualan (Sales Analytics)
        $salesPeriod = $request->input('period', 'last_30_days'); // Default 30 hari
        list($salesLabels, $salesData) = $this->getSalesChartData($salesPeriod);

        return view('owner.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'monthlyRevenue',
            'lowStockProducts',
            'recentOrders',
            'salesLabels', // Untuk chart
            'salesData',   // Untuk chart
            'salesPeriod'  // Untuk seleksi dropdown chart
        ));
    }

    public function profile()
    {
        return view('owner.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Email harus unik kecuali untuk user itu sendiri
            'password' => 'nullable|string|min:8|confirmed', // Password opsional, minimal 8 karakter, harus dikonfirmasi
            'telephone' => 'nullable|string|max:15', // Telepon opsional, maks 15 karakter
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) { // Jika password diisi, hash dan simpan
            $user->password = Hash::make($request->password);
        }

        $user->telephone = $request->telephone; // Update telepon (akan null jika tidak diisi)

        $user->save(); // Simpan perubahan ke database

        return redirect()->route('owner.profile')->with('success', 'Profile updated successfully.');
    }

     public function settings()
    {
        return view('owner.settings'); // Hanya mengembalikan view settings
    }

 // Metode baru untuk menyimpan pengaturan dari form
    public function updateSettings(Request $request)
    {
        // Validasi input dari form settings
        $request->validate([
            'report_period' => 'required|in:30,90,365', // Contoh validasi untuk dropdown report period
            'email_notifications' => 'boolean', // Contoh validasi untuk checkbox
        ]);

        return redirect()->route('owner.settings')->with('success', 'Settings updated successfully!');
    }

    // Helper method untuk mengambil data chart penjualan
    private function getSalesChartData($period)
    {
        $now = Carbon::now();
        $labels = [];
        $data = [];
        $query = Order::where('status', 'selesai'); // Hanya order yang selesai/completed

        switch ($period) {
            case 'last_7_days':
                $startDate = $now->copy()->subDays(6)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                for ($i = 6; $i >= 0; $i--) {
                    $date = $now->copy()->subDays($i);
                    $labels[] = $date->format('M d');
                }
                $salesRecords = $query->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('SUM(total_amount) as total')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('total', 'date')
                    ->toArray();
                for ($i = 6; $i >= 0; $i--) {
                    $date = $now->copy()->subDays($i)->format('Y-m-d');
                    $data[] = $salesRecords[$date] ?? 0;
                }
                break;
                
            case 'last_30_days':
            default:
                $startDate = $now->copy()->subDays(29)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                for ($i = 29; $i >= 0; $i -= 5) { // Label setiap 5 hari
                    $labels[] = $now->copy()->subDays($i)->format('M d');
                }
                $salesRecords = $query->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('SUM(total_amount) as total')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('total', 'date')
                    ->toArray();
                $aggregatedData = [];
                for ($i = 29; $i >= 0; $i -= 5) {
                    $total = 0;
                    for ($j = 0; $j < 5 && ($i - $j) >= 0; $j++) {
                        $date = $now->copy()->subDays($i - $j)->format('Y-m-d');
                        $total += $salesRecords[$date] ?? 0;
                    }
                    $aggregatedData[] = $total;
                }
                $data = $aggregatedData;
                break;

            case 'last_6_months':
                $startDate = $now->copy()->subMonths(5)->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                for ($i = 5; $i >= 0; $i--) {
                    $labels[] = $now->copy()->subMonths($i)->format('M Y');
                }
                $salesRecords = $query->select(
                        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                        DB::raw('SUM(total_amount) as total')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray();
                for ($i = 5; $i >= 0; $i--) {
                    $month = $now->copy()->subMonths($i)->format('Y-m');
                    $data[] = $salesRecords[$month] ?? 0;
                }
                break;
                
            case 'last_12_months':
                $startDate = $now->copy()->subMonths(11)->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                for ($i = 11; $i >= 0; $i--) {
                    $labels[] = $now->copy()->subMonths($i)->format('M Y');
                }
                $salesRecords = $query->select(
                        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                        DB::raw('SUM(total_amount) as total')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month')
                    ->toArray();
                for ($i = 11; $i >= 0; $i--) {
                    $month = $now->copy()->subMonths($i)->format('Y-m');
                    $data[] = $salesRecords[$month] ?? 0;
                }
                break;
        }
        return [$labels, $data];
    }

    // Metode untuk Unduh Laporan Penjualan (HTML untuk window.print())
    public function printReport(Request $request)
    {
        $statusFilter = $request->input('status', ''); // Filter status dari request (opsional)

        $orders = Order::with('user', 'items.product')
            ->when($statusFilter, function ($query, $statusFilter) {
                return $query->where('status', strtolower($statusFilter)); // Convert to lowercase if DB stores lowercase
            })
            ->latest()
            ->get();

        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'selesai')
            ->sum('total_amount');
            
        $reportDate = Carbon::now()->format('d M Y H:i:s');
        $logoPath = public_path('assets/images/logo-your-company.png'); // Ganti dengan path logo Anda

        return view('owner.print', compact('orders', 'monthlyRevenue', 'reportDate', 'logoPath'));
    }
}