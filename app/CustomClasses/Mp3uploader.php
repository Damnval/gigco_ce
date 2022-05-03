<?php

namespace App\CustomClasses;

class Mp3uploader
{
    /**
     * Will get the needed data for saving mp3 audio
     *
     * @param $file_audio
     * @return void
     */
    public function getData($file_audio)
    {
        $audio = new \wapmorgan\Mp3Info\Mp3info($file_audio, true);

        $data['title'] = $file_audio->getClientOriginalName();
        $data['url'] = $file_audio->storeAs('public/upload/files/audio', time().'-'.$data['title']);
        $data['duration'] = $audio->duration;

        return $data;
    }
}
