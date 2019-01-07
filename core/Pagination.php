<?php

namespace Core;


class Pagination
{
    public $total;
    public $current;
    public $limit;
    public $url;

    public function __construct($total, $current, $url, $limit = 10)
    {
        $this->current = $current;
        $this->limit = $limit;
        $this->url = $url;
        $this->total = $total;
    }

    public function render() {
        ob_start();

        $page = ceil($this->total/$this->limit);

        for($i=1; $i<=$page; $i++) {
            if($i == $this->current) {
                echo '<a href="'.$this->url.'?page='.$i.'" data-page="'.$i.'" class="cur_page">'.$i.'</a>';
            } else {
                echo '<a href="'.$this->url.'?page='.$i.'" data-page="'.$i.'">'.$i.'</a>';
            }
        }

        $paginate = ob_get_contents();
        ob_end_clean();
        return $paginate;
    }
}