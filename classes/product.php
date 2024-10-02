<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/lib/database.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/cake_sale" . "/helpers/format.php");
?>

<?php
class Products
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
}

?>