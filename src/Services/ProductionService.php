<?php
/* START: ProductionService Implementation */

namespace App\Services;

class ProductionService {
    /**
     * Generate JATS XML for a manuscript
     */
    public function generateJATS(array $manuscript, array $author): string {
        $doi = "10.1234/journaldb." . bin2hex(random_bytes(4));
        
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><article/>');
        $xml->addAttribute('article-type', 'research-article');
        
        $front = $xml->addChild('front');
        $journalMeta = $front->addChild('journal-meta');
        $journalMeta->addChild('journal-title', 'Journal of Advanced Clinical Research');
        
        $articleMeta = $front->addChild('article-meta');
        $articleMeta->addChild('article-id', $doi)->addAttribute('pub-id-type', 'doi');
        
        $titleGroup = $articleMeta->addChild('title-group');
        $titleGroup->addChild('article-title', htmlspecialchars($manuscript['title']));
        
        $contribGroup = $articleMeta->addChild('contrib-group');
        $contrib = $contribGroup->addChild('contrib');
        $contrib->addAttribute('contrib-type', 'author');
        $name = $contrib->addChild('name');
        $name->addChild('surname', htmlspecialchars($author['full_name']));
        
        $abstract = $articleMeta->addChild('abstract');
        $abstract->addChild('p', htmlspecialchars($manuscript['abstract']));
        
        return $xml->asXML();
    }
}

/* END: ProductionService Implementation */
?>
