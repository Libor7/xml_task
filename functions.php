<?php 

function get_xml_files_from_current_dir() {
  $directory_content = new FilesystemIterator(__DIR__, FilesystemIterator::CURRENT_AS_PATHNAME);
  $xml_files = [];

  foreach ($directory_content as $file) {
    $temp_arr = explode('\\', $file);
    if(pathinfo($temp_arr[count($temp_arr) - 1], PATHINFO_EXTENSION) == 'xml') {
      $xml_files[] = $temp_arr[count($temp_arr) - 1];
    }
  }

  return $xml_files;
}

function xml_files_to_array($xml_files) {
  $xml_arr = [];
  foreach ($xml_files as $file) {
    $xml_object = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOCDATA);
    $array = json_decode(json_encode((array)$xml_object), TRUE);
    $xml_arr = array_merge($xml_arr, $array['SHOPITEM']);
  }
  return $xml_arr;
}

function price_sort_asc($x, $y) {
  return ($x['PRICE'] > $y['PRICE']);
}

function order_by_price_asc($xml_arr) {
  uasort($xml_arr, 'price_sort_asc');
}

function create_table($xml_arr, $amount) {
  $table = '<table><tr><th>Product name</th><th>Description</th><th>URL</th><th>Image</th><th>Price</th></tr>';

  foreach (array_slice($xml_arr, 0, $amount) as $arr) {
    $table .= '<tr><td>'.$arr["PRODUCTNAME"].'</td><td>'.$arr["DESCRIPTION"].'</td><td><a href="'.$arr["URL"].'" target="_blank">See the product details</a></td><td><img src="'.$arr["IMGURL"].'" alt="Image" width="100" /></td><td>'.$arr["PRICE"].'</td></tr>';
  }

  $table .= '</table><br />';

  if($amount < count($xml_arr)) {
    $table .= '<button type="button" id="loadMore">Load more</button>';
  }

  echo $table;
}
