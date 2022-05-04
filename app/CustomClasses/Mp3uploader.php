<?php

namespace App\CustomClasses;

use wapmorgan\Mp3Info\Mp3Info;

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
        $audio = new Mp3Info($file_audio, true);

        $data['file_name'] = $file_audio->getClientOriginalName();
        $data['file_path'] = $file_audio->storeAs('public/upload/files/audio', time() . '-' . $data['file_name']);
        $data['duration'] = $audio->duration;

        return $data;
    }
}
