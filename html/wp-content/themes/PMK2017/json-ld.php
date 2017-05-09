<?php

$staticPayload = array(
    "@context" => "http://schema.org",
    "@type" => "Organization",
    "url" => "https://pikmykid.com",
    "logo" => "https://pikmykid.com/logo.png",
    "sameAs" => array(
        "http://facebook.com/pikmykid",
        "http://www.twitter.com/pikmykid",
        "http://instagram.com/pikmykid"
    )
);

if(is_front_page()){

    $dynamicPayload = array(
        "@context" => "http://schema.org",
        "@type" => "Website",
        "name" => "PikMyKid",
        "url" => get_home_url(),
        "logo" => "https://pikmykid.com/logo.png"
    );

}else{

    $dynamicPayload = array(
        "@context" => "http://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => array(
            array(
                "@type" => "ListItem",
                "position" => 1,
                "item" => array(
                    "@id" => get_home_url(),
                    "name" => "PikMyKid"
                )
            ),
            array(
                "@type" => "ListItem",
                "position" => 2,
                "item" => array(
                    "@id" => get_permalink(),
                    "name" => get_the_title()
                )
            )
        )
    );
    
}

?>
