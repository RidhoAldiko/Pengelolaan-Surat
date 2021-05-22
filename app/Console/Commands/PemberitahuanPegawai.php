<?php

namespace App\Console\Commands;

use App\Models\RiwayatKGB;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
class PemberitahuanPegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pemberitahuan:pegawai';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pemberitahuan bulanan pegawai apakah ada KGB dan Pangkat berakhir pada setiap bulan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dataKGB     = RiwayatKGB::with(['pegawai','gaji'])->where('status',0)->orderBy('id_riwayat_kgb','desc')->get();
        $users       = User::where('role',2)->get();    
        $data        = [];     
        //jika ada data kgb yang masih aktif
        if ($dataKGB->count() > 0) {

            foreach ($dataKGB as $key => $value) {
                $akhir =strtotime(now());
                $awal = strtotime($value->batas_berlaku); 
                $selisih =floor(($akhir - $awal) / (60 * 60 * 24 * 30));
                //jika masa aktif 2 bulan lagi maka kirim email ke operator ada pegawai kgb yang mau habis
                if ($selisih <= 2 && $selisih >= 0) {
                   $data[] = $value->pegawai->nama_pegawai;
                }
            }
            if (count($data) > 0) {
               //kirim email pemberitahuan ke operator
                    foreach ($users as $user) {
                        Mail::raw('Pada bulan ini ADA pegawai yang Kenaikan Gaji Berkali (KGB) berakhir pada bulan ini. Silahkan cek ke sistem',function($message) use($user){
                            $message->to($user->email);
                            $message->subject('Pada bulan ini ADA pegawai yang Kenaikan Gaji Berkali (KGB) berakhir pada bulan ini. Silahkan cek ke sistem');
                        });
                    }
            }else{
               //kirim email pemberitahuan ke operator
               foreach ($users as $user) {
                    Mail::raw('Pada bulan ini TIDAK ADA pegawai yang Kenaikan Gaji Berkali (KGB) berakhir pada bulan ini.',function($message) use($user){
                        $message->to($user->email);
                        $message->subject('Pada bulan ini TIDAK ADA pegawai yang Kenaikan Gaji Berkali (KGB) berakhir pada bulan ini.');
                    });
                } 
            }
            
        }
        $this->info('Pengiriman email berhasil');
        
    }
}
