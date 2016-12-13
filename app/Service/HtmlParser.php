<?php namespace App\Service;

class HtmlParser  {
    public function getOgData($html) {
        libxml_use_internal_errors(true); // Yeah if you are so worried about using @ with warnings
        $doc = new \DomDocument();
        $doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);
        $query = '//*/meta[starts-with(@property, \'og:\')]';
        $metas = $xpath->query($query);
        $rmetas = [];
        foreach ($metas as $meta) {
            $property = $meta->getAttribute('property');
            $content = $meta->getAttribute('content');
            $rmetas[$property] = $content;
        }
        return $rmetas;
    }


}