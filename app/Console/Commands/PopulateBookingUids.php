<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Illuminate\Support\Str;

class PopulateBookingUids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:populate-uids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate UID field for existing bookings that don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::whereNull('uid')->get();
        
        if ($bookings->isEmpty()) {
            $this->info('All bookings already have UIDs.');
            return 0;
        }

        $this->info("Found {$bookings->count()} bookings without UIDs. Populating...");

        $bar = $this->output->createProgressBar($bookings->count());
        $bar->start();

        foreach ($bookings as $booking) {
            do {
                $uid = strtoupper(Str::random(8));
            } while (Booking::where('uid', $uid)->exists());

            $booking->uid = $uid;
            $booking->save();
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Successfully populated UIDs for all bookings.');

        return 0;
    }
}
