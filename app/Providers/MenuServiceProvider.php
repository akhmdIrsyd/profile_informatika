<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use App\Models\Konten;
use App\Models\WebGambar;
use App\Models\WebText;
use Illuminate\Support\Facades\View;
class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // Mengirimkan data menu ke semua view yang menggunakan layouts.app
        
        View::composer('admin.layout', function ($view) {
            $menuLimits = [
                'informasi' => 1,
                'profil' => 4,
                'akademik' => 9,
                'kemahasiswaan' => 2,
                'penelitian-dan-pengabdian' => 2
            ];
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with(['konten'=> function ($query) use ($menuLimits, $menuName) {
                    $query->limit($menuLimits[$menuName]); // Sesuaikan jika perlu
                }])
                ->where('url', $menuName)
                ->get();
            }

            $view->with('menus', $menus);
        });

        View::composer('Landing.layout', function ($view) {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                    ->where('url', $menuName)
                    ->get();
            }

            $namaprodi = WebText::where('nama', 'Nama Prodi')->first();
            $logouniv = WebGambar::where('nama', 'Logo Universitas')->first();
            $logoprodi = WebGambar::where('nama', 'Logo Website')->first();

            $logomenteri = WebGambar::where('nama', 'Logo Kementerian')->first();

            $textwelcome = WebText::where('nama', 'text welcome')->first();
            $alamat = WebText::where('nama', 'Alamat')->first();
            $youtube = WebText::where('nama', 'Youtube')->first();
            $instagram = WebText::where('nama', 'Instagram')->first();
            $telpon = WebText::where('nama', 'Telpon')->first();
            $email = WebText::where('nama', 'Email')->first();
            $view->with(compact('instagram','youtube','menus', 'namaprodi', 'logouniv', 'logoprodi', 'logomenteri', 'textwelcome', 'alamat', 'alamat','telpon', 'email'));
        });
    }
}
