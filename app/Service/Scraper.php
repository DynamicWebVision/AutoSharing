<?php namespace App\Service;

class Scraper {

    public $exchange;
    public $timePeriod;
    public $baseUrl;

    public function getCurl($url) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);

        curl_close($curl);

        return $resp;
    }

    public function getLinksInClass($html, $class) {
        $urls = [];
        while (strpos($html, $class) !== false) {
            $htmlToEndFromClass = substr($html, strpos($html, $class));
            $urlEndpoint = $this->getNextHref($htmlToEndFromClass);
            $urls[] = $this->baseUrl.$urlEndpoint;
            $html = substr($htmlToEndFromClass, strpos($htmlToEndFromClass, "href=")+6);
        }
        return $urls;
    }

    //
    public function getNextHref($text) {
        $linkToEnd = substr($text, strpos($text, "href=")+6);
        return substr($linkToEnd, 0, strpos($linkToEnd, '"'));
    }

    public function getInBetween($text, $start, $end) {
        $startToEnd = substr($text, strpos($text, $start));
        return substr($startToEnd, strpos($startToEnd, $start) + strlen($start), strpos($startToEnd, $end) -strlen($start) );
    }

    public function getContactLink($text) {

        while (strpos(strtoupper($text), 'CONTACT') !== false) {
            $textToContact = substr($text, 0, strpos(strtoupper($text), 'CONTACT'));

            $reverseTextToContact = strrev($textToContact);

            if (strpos(strtoupper($reverseTextToContact), 'A<') !== false) {
                $anchorPosition = strpos(strtoupper($reverseTextToContact), 'A<');

                if ($anchorPosition < 50) {
                    $anchorSubtract = $anchorPosition+2;
                    $anchorOpenToEnd = substr($text, strpos(strtoupper($text), 'CONTACT')-$anchorSubtract);

                    $anchor = substr($anchorOpenToEnd, 0, strpos($anchorOpenToEnd, '</a')+4);

                    return $this->getUrlFromAnchor($anchor);

                    break;
                }
                else {
                    $text = substr($text, strpos(strtoupper($text), 'CONTACT')+7);
                }
            }
            else {
                $text = substr($text, strpos(strtoupper($text), 'CONTACT')+7);
            }
        }
    }

    public function getUrlFromAnchor($anchor) {
        $anchor = str_replace('"', "'", $anchor);
        $anchor = str_replace(' ', '', $anchor);

        $linkStartToEnd = substr($anchor, strpos($anchor, 'href')+6);
        $link = substr($linkStartToEnd, 0, strpos($linkStartToEnd, "'"));

        if (substr($link, 0, 1) == '/') {
            return $this->baseUrl.$link;
        }
        else {
            return $link;
        }
    }

    public function getEmailAddressesInLink($link) {
        $html = $this->getCurl($link);
        $emails = [];

        while (strpos(strtoupper($html), '@') !== false) {
            $atPosition = strpos($html, "@");

            $foundEmailStart = false;

            while (!$foundEmailStart) {
                $atPosition--;
                $previousCharacter = substr($html, $atPosition, 1);

                if (!ctype_alnum($previousCharacter)) {
                    $html = substr($html, $atPosition+1);
                    $foundEmailStart = true;
                }
            }
            $emailDotPosition = strpos($html, ".");
            $foundEmailEnd = false;

            while (!$foundEmailEnd) {
                $emailDotPosition++;
                $nextCharacter = substr($html, $emailDotPosition, 1);

                if (!ctype_alnum($nextCharacter)) {
                    $email = substr($html,0,$emailDotPosition);
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !in_array($email, $emails)) {
                        $emails[] = $email;
                    }
                    $foundEmailEnd = true;
                }
            }
            $html = substr($html, $emailDotPosition);
        }
        return $emails;
    }
}
