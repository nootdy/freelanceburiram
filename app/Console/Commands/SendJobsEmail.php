<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendJobsEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ส่งเมลไปหาฟรีแลนซ์ทุกวัน ว่ามีงานไหนบ้างที่ตรงประเภทงานที่เลือกไว้';

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
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('f_job_categories','=','ไอที/ซอฟต์แวร์')->where('id',8)->get();

        foreach($users as $user){
          //send mail to users
          Mail::queue('emails.daily_jobs',['user' => $user],function($mail) use ($user){
            $mail->to($user['email'])
              ->form('freelanceburiram@gmail.com','FreelanceBuriram')
              ->subject('งานใหม่มาแล้วจ้า');
          });
        }
        $this->info('เมลถูกส่งเรียบร้อยแล้ว');

    }
}
