<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Setting;
use Config;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $semester = Semester::where('periode_aktif', 1)->first();
        $this->request->session()->put('semester_id', $semester->nama);
        $this->request->session()->put('semester_aktif', $this->request->semester);
        $sekolah_id = ($event->user->sekolah_id) ? $event->user->sekolah_id : NULL;
        $nama_sekolah = ($event->user->sekolah_id) ? $event->user->sekolah->nama : 'Yayasan Ariya Metta';
        $this->request->session()->put('sekolah_id', $sekolah_id);
        $this->request->session()->put('nama_sekolah', $nama_sekolah);
        //dd($sekolah_id);
        /*if($sekolah_id){
            foreach (Setting::where('sekolah_id', $sekolah_id)->get() as $setting) {
                //Config::set('settings.'.$sekolah_id.'.'.$setting->key, $setting->value);
                $this->request->session()->put('settings_'.$sekolah_id.'_'.$setting->key, $setting->value);
            }
        } else {
            foreach (Setting::all() as $setting) {
                //$this->request->session()->put('settings_'.session('sekolah_id').'_'.$setting->key, $setting->value);
                $this->request->session()->put('settings_'.$setting->sekolah_id.'_'.$setting->key, $setting->value);
            }
        }*/
    }
}
