<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class PenaPpibandirma extends Component
{
    public $post, $posts;

    public function fetchRecentPost(){
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://blog.ppibandirma.com/wp-json/wp/v2/posts?_embed');
            $posts = json_decode($response->getBody(), true);
            
            if (!empty($posts)) {
                $this->post = $posts[0];
                $this->posts = array_slice($posts, 1, 5);
            }
            
        } catch (\Exception $e) {
            // Handle the exception, such as logging or displaying an error message
        }
    }

    public function mount(){
        $this->fetchRecentPost();
    }
    public function render()
    {
        return view('livewire.pena-ppibandirma');
    }
}
