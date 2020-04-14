<?php
declare(strict_types=1);

namespace vDesk\Packages;

use vDesk\Archive\Element;
use vDesk\DataProvider\Expression;
use vDesk\Package;
use vDesk\Utils\Log;

/**
 * Package that adds a "Pr0n"-folder to the Archive.
 * This is the world's most important package; 'cause everyone should have a Pr0n-folder!
 *
 * @todo    Implement password protection.
 *
 * @package vDesk\Packages
 */
class Pr0n extends Package {
    
    /**
     * The name of the Package.
     */
    public const Name = "Pr0n";
    
    /**
     * The version of the Package.
     */
    public const Version = "1.0.0";
    
    /**
     * The name of the Package.
     */
    public const Vendor = "Kerry <DevelopmentHero@gmail.com>";
    
    /**
     * The name of the Package.
     */
    public const Description = "Adds a Pr0n folder to the Archive.";
    
    /**
     * The names of the dependency Packages of the Package.
     */
    public const Dependencies = ["Archive" => "1.0.0"];
    
    /**
     * The license of the Package.
     */
    public const License = "WTFPL";
    
    /**
     * The license text of the Package.
     */
    public const LicenseText = <<<License
            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
                    Version 2, December 2004

 Copyright (C) 2004 Sam Hocevar <sam@hocevar.net>

 Everyone is permitted to copy and distribute verbatim or modified
 copies of this license document, and changing it is allowed as long
 as the name is changed.

            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

  0. You just DO WHAT THE FUCK YOU WANT TO.
License;
    
    /**
     * @inheritDoc
     */
    public static function Install(\Phar $Phar, string $Path): void {
        
        /** @var \vDesk\Archive\Element $Pr0n */
        $Pr0n            = \vDesk\Modules::Archive()::CreateFolder(new Element(Element::Archive), "Pr0n");
        $Pr0n->Thumbnail = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAACbUlEQVRYCe1XTWgTQRh9mx8SV1yTrW20iVjUsKAHf4qgXr0pKP4c7EUQPOlVUK968erFk6delB5EUY/eFMVS9dRSL0XamKaaJqExpG6Sdb+PNsZ02R8zqZcZ+HZm3rzvzcebzSQBZJMO/F8HFNp+/N7phR1JlYauYTUtrNR+Pbl858VNV6LAxQhp6VrczGaSI/DRyiv1G4/vn1HHbr+67oPeMyUUVCGxLR7fl9Gv2kU+DJr7L3w+4pcPLswZewZG4LOZjRa+LlWbqqpCUVjCZ6Z/Wm6xiLFbzyN8xP7TgB+VOhCO4eSxg+FIOBwkNRDXNBsNSuACq6ut3d+rLZp7xuDQEIZTuidPFIELHNQ169CBvaI0heqEhKr1QUwW2Kup0kHpYK8O9Jrv+g4W3+UwffcNmjW+1HmvZs1kjNYIoF4Eh7ScwrXAgRNpbMlomJ+YbufOT8wwRmsEUi+CQ1pO4VogJWQuGfg5V0H5cwGlTwV7XAZhtLYeNBfBWdfr7PmrrhPoHke1GIbPZpF7OstL6XNZEMaTtQfNRXDW5P7qPB0kdnJ0J0KREBQ7EqO7CNoQojjdwr4KLE0twmpZHOWpfLcGz0VxWKzj4XnEZmUVuWdfkLlowLKABfuot+7XEd0ea8uI4rQFOwbuDtoV0adWM3QkDqeQPJICjQnjaklIFIe0HMK1wOUPedTzVaTPG+1UGhO2PJlnTBSHxRwe/Ifi9aMr5vGjhudxO+T3DXr/cbZx6tp41NXBvu0eQFgWGMAsR6p00NGWAKB0MIBZjlS++74tlZS3kzN/fpU6UjcXLBQrfEdv7q5yN+nARgd+A3f9OmjlBkzcAAAAAElFTkSuQmCC";
        $Pr0n->Save();
        Log::Info(__METHOD__, "Created 'Pr0n' folder.");
        
        self::Deploy($Phar, $Path);
        
    }
    
    /**
     * @inheritDoc
     */
    public static function Uninstall(string $Path): void {
        
        $Result = Expression::Select("ID")
                            ->From("Archive.Elements")
                            ->Where(["Name" => "Pr0n"])
                            ->Execute();
        if($Result->Count > 0) {
            \vDesk\Modules::Archive()::DeleteElements([(int)$Result->ToValue()]);
            Log::Info(__METHOD__, "Deleted 'Pr0n' folder.");
        }
        
        self::Undeploy();
        
    }
}