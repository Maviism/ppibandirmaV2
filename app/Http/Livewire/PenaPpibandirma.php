<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class PenaPpibandirma extends Component
{
    public $post, $posts;

    public function fetchRecentPosts()
    {
        $this->posts = Cache::remember('recent_posts_wp', now()->addMinutes(60), function(){
            $client = new Client();
            
            try {
                $response = $client->request('GET', 'https://blog.ppibandirma.com/wp-json/wp/v2/posts?_embed');
                $posts = json_decode($response->getBody(), true);
                
                if (!empty($posts)) {
                    return array_slice($posts, 0, 6);
                }
            } catch (\Exception $e) {
                // Handle the exception, such as logging or displaying an error message
            }
            
            return [];
        });
        
        // Assign the first post to $post
        if (!empty($this->posts)) {
            $this->post = $this->posts[0];
            array_shift($this->posts); // Remove the first post from the posts array
        }
    }

    public function mount(){
        $this->fetchRecentPosts();
    }
    public function render()
    {
        return view('livewire.pena-ppibandirma');
    }
}
