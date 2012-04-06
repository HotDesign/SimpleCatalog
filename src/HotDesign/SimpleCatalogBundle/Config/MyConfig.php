<?php

namespace HotDesign\SimpleCatalogBundle\Config;

/**
 * Clase estática que se encarga de hacer un manejo de los tipos de avisos y sus extensiones
 * 
 */
class MyConfig {
    public static $default_lat = -31.632301;
    public static $default_lng = -60.716157;    
  
    public static $items_per_pages = 10;
    public static $items_per_page_backend = 10;

    public static $image_max_size_bytes  = 10485760;  //bytes


    public static $max_image_per_item = 5;
  

    public static $sitename = 'SimpleCatalog';
    public static $image_upload_path = 'catalog/images/';  

}