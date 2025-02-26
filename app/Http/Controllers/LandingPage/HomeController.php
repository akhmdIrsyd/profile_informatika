<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\admin\DosenController;
use App\Http\Controllers\Controller;
use App\Models\alumni;
use Illuminate\Http\Request;
use App\Models\ProfileDosen;
use App\Models\WebGambar;
use App\Models\WebText;
use App\Models\Informasi;
use App\Models\Kegiatan;
use App\Models\TipeInfo;
use App\Models\Menu;
use App\Models\Profil;
use App\Models\Konten;
use App\Models\Kurikulum;
use App\Models\MataKuliah;
use App\Models\ketetatan;
use App\Models\detail_alumni;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function notfound($menu, $submenu = null)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }


            return view('Landing.notfound', compact('menu', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function index()
    {
        // 
        try {
            // Ambil data tahun terbaru
            $dataTerbaru = ketetatan::orderBy('tahun', 'desc')->first();

            // Jika data kosong, set default nilai 100 untuk semua
            if (!$dataTerbaru) {
                $dataTerbaru = (object)[
                    'tahun' => date('Y'),
                    'jml_snmptn' => 100,
                    'kuota_snmptn' => 100,
                    'jml_sbnptn' => 100,
                    'kuota_sbnptn' => 100,
                    'jml_mandiri' => 100,
                    'kuota_mandiri' => 100,
                ];
            }

            // Hitung persentase penerimaan
            $persentase = [
                'snmptn' => ($dataTerbaru->kuota_snmptn / max($dataTerbaru->jml_snmptn, 1)) * 100,
                'sbnptn' => ($dataTerbaru->kuota_sbnptn / max($dataTerbaru->jml_sbnptn, 1)) * 100,
                'mandiri' => ($dataTerbaru->kuota_mandiri / max($dataTerbaru->jml_mandiri, 1)) * 100,
            ];
            // Hitung total jumlah peminat
            $total_peminat = $dataTerbaru->jml_snmptn + $dataTerbaru->jml_sbnptn + $dataTerbaru->jml_mandiri;


            $today = now(); 
            $dosens = ProfileDosen::limit(3)->get();
            $count_dosens = ProfileDosen::count();
            $professorCount = ProfileDosen::where('jabatan', 'professor')->count();
            $totalLulus = alumni::sum('juml_lulus'); // Hitung total lulusan
            $totalaktif = alumni::sum('juml_masuk'); // Hitung total lulusan
            $slider1= WebGambar::where('nama', 'Gambar Selamat Datang')->first();
            $slider2 = Informasi::orderBy('created_at', 'desc')->first();
            $slider3 = Informasi::orderBy('created_at', 'desc')->skip(1)->first();
            $namaprodi1 = WebText::where('nama', 'Nama Prodi')->first();
            $videoProfil = WebText::where('nama', 'Video Profil')->first();
            $textwelcome = WebText::where('nama', 'text welcome')->first();
            $alamat = WebText::where('nama', 'Alamat')->first();
            $telpon = WebText::where('nama', 'Telpon')->first();
            $email = WebText::where('nama', 'Email')->first();
            $logouniv = WebGambar::where('nama', 'Logo Universitas')->first();
            $logomenteri = WebGambar::where('nama', 'Logo Kementerian')->first();
            $kegiatan = Kegiatan::whereDate('tanggal', '>=', $today) // Filter berdasarkan tanggal
                ->limit(3) // Batasi hanya 2 hasil
                ->get();
            $pengumuman = Informasi::with('TipeInfo')
                ->whereHas('TipeInfo', function ($query) {
                    $query->where('nama', 'Pengumuman'); // Filter based on 'nama' column in TipeInfo table
                })

                ->orderBy('created_at', 'desc') // Sort by latest
                ->limit(4)
                ->get();
            $informasi = Informasi::orderBy('created_at', 'desc')->limit(1)->get();
            $alumni = detail_alumni::orderBy('created_at', 'desc')->limit(4)->get();
            return view('Landing.index', compact('alumni','total_peminat','persentase','totalaktif','totalLulus','professorCount','count_dosens','logomenteri','informasi','pengumuman','kegiatan','logouniv','dosens', 'slider1', 'namaprodi1', 'slider2', 'slider3', 'videoProfil', 'textwelcome', 'alamat', 'email', 'telpon'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
        
    }

    public function konten($menu, $submenu = null)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                    ->where('url', $menuName)
                    ->get();
            }

            $menu = Menu::where('url', $menu)->firstOrFail();

            if ($submenu) {
                // Jika submenu ada, cari kontennya
                $konten = Konten::where('url', $submenu)->where('menu_id', $menu->id)->firstOrFail();
            } else {
                $konten = null; // Tidak ada submenu, tampilkan halaman utama menu
            }

            return view('Landing.detailkonten', compact('menu', 'konten', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function berita(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                    ->where('url', $menuName)
                    ->get();
            }

            $informasi = Informasi::whereHas('TipeInfo', function ($query) {
                $query->where('nama', 'Berita');
            })->with('TipeInfo')->orderBy('created_at', 'desc')->paginate(5);



            return view('Landing.listinformasi', compact('informasi', 'menus' ));
                
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function beasiswa(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $informasi = Informasi::whereHas('TipeInfo', function ($query) {
                $query->where('nama', 'Beasiswa');
            })->with('TipeInfo')->orderBy('created_at', 'desc')->paginate(5);



            return view('Landing.listinformasi', compact('informasi', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function pengumuman(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $informasi = Informasi::whereHas('TipeInfo', function ($query) {
                $query->where('nama', 'Pengumuman');
            })->with('TipeInfo')->orderBy('created_at', 'desc')->paginate(5);



            return view('Landing.listinformasi', compact('informasi', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function prestasi(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $informasi = Informasi::whereHas('TipeInfo', function ($query) {
                $query->where('nama', 'Prestasi');
            })->with('TipeInfo')->orderBy('created_at', 'desc')->paginate(5);



            return view('Landing.listinformasi', compact('informasi', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }


    public function detailinformasi(string $id)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = Informasi::findOrFail($id);



            return view('Landing.detailinformasi', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

   

    public function kegiatan(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = Kegiatan::orderBy('created_at', 'desc')->paginate(5);



            return view('Landing.listkegiatan', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function detailkegiatan(string $id)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = Kegiatan::findOrFail($id);



            return view('Landing.detailkegiatan', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }



    public function dosen(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = ProfileDosen::orderBy('created_at', 'desc')->paginate(5);


            return view('Landing.listdosen', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function detaildosen(string $id)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = ProfileDosen::findOrFail($id);


            return view('Landing.detaildosen', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function tendik(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = Profil::orderBy('created_at', 'desc')->paginate(5);


            return view('Landing.listtendik', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function detailtendik(string $id)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas = Profil::findOrFail($id);


            return view('Landing.detailtendik', compact('datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function scrapeBooks()
    {
        $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
        $menus = [];

        foreach ($menuNames as $menuName) {
            $menus[$menuName] = Menu::with('konten')
            ->where('url', $menuName)
                ->get();
        }
        // Initialize the HttpClient and BrowserKit HttpBrowser
        $client = new HttpBrowser(HttpClient::create());
        $url = 'https://sinta.kemdikbud.go.id/departments/profile/411/E890EFD6-EDC3-46B9-8DF6-E9F24BD8E1A2/09228E46-5218-4676-B44D-1BBDF2AE9872/?view=books';

        // Make a request to the URL
        $client->request('GET', $url);

        // Get the response status code directly from the HttpBrowser client
        $statusCode = $client->getResponse()->getStatusCode();

        // Check if the page was successfully loaded
        if ($statusCode != 200) {
            return response()->json(['error' => 'Failed to load page'], 400);
        }

        // Scrape the relevant data
        $crawler = $client->getCrawler(); // Get the crawler from the client
        $books = $crawler->filter('.ar-list-item')->each(function ($node) {
            return [
                'ar_title' => $node->filter('.ar-title')->text(),
                'ar_meta' => $node->filter('.ar-meta')->filter('a')->first()->text(),
                'ar_pub' => $node->filter('.ar-pub')->text(),
                'ar_year' => $node->filter('.ar-year')->text(),
            ];
        });

        // Return the scraped data to a view
        return view('Landing.buku', compact('books', 'menus'));
    }

    public function scrapeServices()
    {
        $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
        $menus = [];

        foreach ($menuNames as $menuName) {
            $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                ->get();
        }
        // Initialize the HttpClient and BrowserKit HttpBrowser
        $client = new HttpBrowser(HttpClient::create());
        $url = 'https://sinta.kemdikbud.go.id/departments/profile/411/E890EFD6-EDC3-46B9-8DF6-E9F24BD8E1A2/09228E46-5218-4676-B44D-1BBDF2AE9872/?view=services';

        // Make a request to the URL
        $client->request('GET', $url);

        // Get the response status code directly from the HttpBrowser client
        $statusCode = $client->getResponse()->getStatusCode();

        // Check if the page was successfully loaded
        if ($statusCode != 200) {
            return response()->json(['error' => 'Failed to load page'], 400);
        }

        // Scrape the relevant data
        $crawler = $client->getCrawler(); // Get the crawler from the client
        $books = $crawler->filter('.ar-list-item')->each(function ($node) {
            return [
                'ar_title' => $node->filter('.ar-title')->text(),
                'ar_meta' => str_replace('Leader : ', '', $node->filter('.ar-meta')->filter('a')->first()->text(),),

                'ar_pub' => $node->filter('.ar-pub')->text(),
                'ar_year' => $node->filter('.ar-year')->text(),
            ];
        });

        // Return the scraped data to a view
        return view('Landing.buku', compact('books','menus'));
    }

    public function scrapeResearchs()
    {
        $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
        $menus = [];

        foreach ($menuNames as $menuName) {
            $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                ->get();
        }
        // Initialize the HttpClient and BrowserKit HttpBrowser
        $client = new HttpBrowser(HttpClient::create());
        $url = 'https://sinta.kemdikbud.go.id/departments/profile/411/E890EFD6-EDC3-46B9-8DF6-E9F24BD8E1A2/09228E46-5218-4676-B44D-1BBDF2AE9872/?view=researches';

        // Make a request to the URL
        $client->request('GET', $url);

        // Get the response status code directly from the HttpBrowser client
        $statusCode = $client->getResponse()->getStatusCode();

        // Check if the page was successfully loaded
        if ($statusCode != 200) {
            return response()->json(['error' => 'Failed to load page'], 400);
        }

        // Scrape the relevant data
        $crawler = $client->getCrawler(); // Get the crawler from the client
        $books = $crawler->filter('.ar-list-item')->each(function ($node) {
            return [
                'ar_title' => $node->filter('.ar-title')->text(),
                'ar_meta' => str_replace('Leader : ', '', $node->filter('.ar-meta')->filter('a')->first()->text(),),

                'ar_pub' => $node->filter('.ar-pub')->text(),
                'ar_year' => $node->filter('.ar-year')->text(),
            ];
        });

        // Return the scraped data to a view
        return view('Landing.buku', compact('books','menus'));
    }

    public function scrapePublications()
    {
        $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
        $menus = [];

        foreach ($menuNames as $menuName) {
            $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                ->get();
        }
        // Initialize the HttpClient and BrowserKit HttpBrowser
        $client = new HttpBrowser(HttpClient::create());
        $url = 'https://sinta.kemdikbud.go.id/departments/profile/411/E890EFD6-EDC3-46B9-8DF6-E9F24BD8E1A2/09228E46-5218-4676-B44D-1BBDF2AE9872/?view=scopus';

        // Make a request to the URL
        $client->request('GET', $url);

        // Get the response status code directly from the HttpBrowser client
        $statusCode = $client->getResponse()->getStatusCode();

        // Check if the page was successfully loaded
        if ($statusCode != 200) {
            return response()->json(['error' => 'Failed to load page'], 400);
        }

        // Scrape the relevant data
        $crawler = $client->getCrawler(); // Get the crawler from the client
        $books = $crawler->filter('.ar-list-item')->each(function ($node) {
            return [
                'ar_title' => $node->filter('.ar-title')->text(),
                'ar_meta' => $node->filter('.ar-meta')->filter('a')->first()->text(),
                'ar_creator' => preg_replace('/^Creator\s*[:|-]\s*/', '', $node->filter('.ar-meta')->filter('a:contains("Creator")')->text()), // Remove "Creator :"
                'ar_pub' => $node->filter('.ar-pub')->text(),
                'ar_year' => $node->filter('.ar-year')->text(),
            ];
        });

        // Return the scraped data to a view
        return view('Landing.publikasi', compact('books','menus'));
    }

    public function listcpl($menu, $submenu = null)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }


            return view('Landing.listcpl', compact('menu', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function list_MK()
    {
        $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
        $menus = [];

        foreach ($menuNames as $menuName) {
            $menus[$menuName] = Menu::with('konten')
            ->where('url', $menuName)
                ->get();
        }
        // Ambil data kurikulum terakhir (misalnya berdasarkan ID tertinggi)
        $latestKurikulum = Kurikulum::orderBy('id', 'desc')->first();

        if ($latestKurikulum) {
            // Ambil data matakuliah berdasarkan kurikulum terakhir, urutkan berdasarkan semester
            $matakuliah = Matakuliah::select('nama', 'semester', 'sks', 'rps')
            ->where('kurikulum_id', $latestKurikulum->id)
                ->orderBy('semester')
                ->get();

            // Kelompokkan data berdasarkan semester
            $dataPerSemester = $matakuliah->groupBy('semester');
        } else {
            $matakuliah = Matakuliah::select('nama', 'semester', 'sks', 'rps')
                ->orderBy('semester')
                ->get();

            // Kelompokkan data berdasarkan semester
            $dataPerSemester = $matakuliah->groupBy('semester');
        }

        // Kirim data ke view
        return view('Landing.listmk', compact('dataPerSemester', 'menus', 'latestKurikulum'));
    }

    public function alumni(Request $request)
    {
        // 
        
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            //
            if ($request->ajax()) {
                $data = detail_alumni::select([
                    'id',
                    'nim',
                    'nama',
                    'testimoni',
                'foto',
                ]);

                return DataTables::of($data)
                ->filterColumn('nama', function ($query, $keyword) {
                    $query->where('nama', 'like', "%{$keyword}%");
                })
                    ->addColumn('action', function ($row) {
                        return '
                        <div class="row custom-block-wrap">
                    <h2 class="mb-3"></h2>
                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="' . asset('foto_alumni/'.$row->foto) . '" style="width: 520px; height: 320px;"
                            class=" ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h6 class="mb-0">' . $row->nama . '</h6>


                            <p>
                                NIM: ' . $row->nim . '
                            </p>
                            <p>
                                Testimoni: ' . $row->testimoni . '
                            </p>
                             </div>
                    </div>
                </div>
                <hr style="border: 2px solid black;">
                    ';
                    })
                    ->rawColumns([ 'action'])
                    ->make(true);
            }

        return view('Landing.listalumni', compact('menus'));
    }

    public function statistik(Request $request)
    {
        // 
        try {
            $menuNames = ['informasi', 'profil', 'akademik', 'kemahasiswaan', 'penelitian-dan-pengabdian'];
            $menus = [];

            foreach ($menuNames as $menuName) {
                $menus[$menuName] = Menu::with('konten')
                ->where('url', $menuName)
                    ->get();
            }

            $datas_alumni = alumni::orderBy('tahun', 'desc')->limit(7)->get();
            // Ambil 7 data terbaru berdasarkan tahun
            $datas = Ketetatan::orderBy('tahun', 'desc')->limit(7)->get();

            // Hitung persentase penerimaan untuk tiap tipe di setiap tahun
            foreach ($datas as $data) {
                $data->persentase_snmptn  = ($data->kuota_snmptn / max($data->jml_snmptn, 1)) * 100;
                $data->persentase_sbnptn  = ($data->kuota_sbnptn / max($data->jml_sbnptn, 1)) * 100;
                $data->persentase_mandiri = ($data->kuota_mandiri / max($data->jml_mandiri, 1)) * 100;
            }


            return view('Landing.liststatistik', compact('datas_alumni','datas', 'menus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
