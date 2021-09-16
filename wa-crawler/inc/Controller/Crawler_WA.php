<?php
namespace Wolfactive\Controller;

class Crawler_WA{
    function __construct(){
        // $this->init_Crawl();
        
    }
    // public function init_Crawl(){
    //      $url = 'https://sstruyen.com/the-loai/huyen-huyen';
    //      $url_parent = 'https://sstruyen.com';
    //     for ($i = 1; $i <= 1; $i++) {
    //         $html_content = file_get_html($url.'/trang-'.$i);
    //         $list_crawler = $html_content->find('.table-list tr');
    //         if (!empty($list_crawler)){
    //             foreach ($list_crawler as $post){
    //                 $slug_story = $post->find('.info h3 a', 0)->href;
    //                 $story_all = file_get_html($url_parent.$slug_story);
    //                 $chap_crawler = $story_all->find('.list-chap ul li');
    //                 if(!empty($chap_crawler)){
    //                     foreach($chap_crawler as $chaps){
    //                         $link_chap = $chaps->find('a', 0)->href;
    //                         $link_chap_content = file_get_html($url_parent.$slug_story.$link_chap);
    //                         $content_chap_crawler = $link_chap_content->find('.content_wrap1 .container1', 0)->plaintext;
    //                         var_dump($content_chap_crawler);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
}