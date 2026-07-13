<?php
class Categories
{
    private $mysqli;


    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getcategory($id)
    {

        $id_category  = mysqli_real_escape_string($this->mysqli, $id);
        $CategorySql = $this->mysqli->query("SELECT * FROM categories WHERE category_id = $id_category ");
        $CategoryRow = mysqli_fetch_array($CategorySql);
        $CategorySql->close();

        return $CategoryRow;
    }

    public function numitemcategory($id_profile)
    {
        $query = $this->mysqli->query("SELECT COUNT(*) as num FROM posts  WHERE active = 1 and category = $id_profile ");
        $total_pages = mysqli_fetch_array($query);
        $total_pages = $total_pages['num'];
        $query->close();

        return  $total_pages;
    }

    public function listitens($CategoryId, $order, $start, $limit)
    {

        if ($order == 'views') {

            $GetPosts = $this->mysqli->query("SELECT * FROM posts WHERE active = 1 and category = $CategoryId ORDER BY views DESC limit $start, $limit");
        } else {

            $GetPosts = $this->mysqli->query("SELECT * FROM posts WHERE active = 1 and category = $CategoryId ORDER BY post_id DESC limit $start, $limit");
        }


        return $GetPosts;
    }


    public function pagination($targetpage, $page, $limit, $total_pages,  $adjacents)
    {

        if ($page == 0) $page = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total_pages / $limit);
        $lpm1 = $lastpage - 1;
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class=\"pagination justify-content-center mt-5\">";
            if ($page > 1)
                $pagination .= "<li class=\"page-item \"><a class=\"page-link\" href=\"$targetpage&page=$prev\">&laquo;</a></li>";
            else
                $pagination .= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">&laquo;</a></li>";

            if ($lastpage < 5 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">$counter</a></li>";
                    else
                        $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$counter\">$counter</a></li>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">$counter</a></li>";
                        else
                            $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$counter\">$counter</a></li>";
                    }
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" aria-disabled=\"true\">...</a></li>";
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$lpm1\">$lpm1</a></li>";
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$lastpage\">$lastpage</a></li>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=1\">1</a></li>";
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=2\">2</a></li>";
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" aria-disabled=\"true\">...</a></li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class=\"active page-item\"><a class=\"page-link\" href=\"#\">$counter</a></li>";
                        else
                            $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$counter\">$counter</a></li>";
                    }
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" aria-disabled=\"true\">...</a></li>";
                    $pagination .= "<li  class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$lpm1\">$lpm1</a></li>";
                    $pagination .= "<li  class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$lastpage\">$lastpage</a></li>";
                } else {
                    $pagination .= "<li  class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=1\">1</a></li>";
                    $pagination .= "<li  class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=2\">2</a></li>";
                    $pagination .= "<li class=\"page-item\"><a class=\"page-link\" aria-disabled=\"true\">...</a></li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">$counter</a></li>";
                        else
                            $pagination .= "<li  class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$counter\">$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1)
                $pagination .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage&page=$next\">&raquo;</a></li>";
            else
                $pagination .= "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">&raquo;</a></li>";
            $pagination .= "</ul>\n";
        }

        return  $pagination;
    }
}
