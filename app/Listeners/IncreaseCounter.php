<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // ($event -> video) ------> model(table)
    public function handle(VideoViewer $event)
    {
        if(!session() -> has('videoIsVisited')){
            $this -> updateViewer($event -> video);
        }
        else {
            return false;
        }
    }

    // method by my to clean code
    function  updateViewer($video){
        $video -> viewers = $video -> viewers + 1 ;
        $video -> save();
        //to make viewer not changed with signed user
        // - put it in session in  key
        session() -> put('videoIsVisited' , $video -> id);
    }
}
