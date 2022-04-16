<?php
namespace App\Helpers;

use Mailjet\Resources;
use vendor\mailjet\src;

use App\Models\Logo;
use DB;

class Email
{
    public static function get_envoimail($email,$nom,$messages){


        $mj = new \Mailjet\Client('fcee0ad26db371fc2074a223389e4c54','217cf5080f4d2ab03095243ce3638952',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "notifications@gna-ci.com",
                        'Name' => "GNA-CI"
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $nom
                        ]
                    ],
                    'Subject' => "Greetings from Mailjet.",
                    'TextPart' => "My first Mailjet email",
                    'HTMLPart' => $messages,
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());

    }


    public static function get_envoimailTemplate($email, $nom, $messages, $sujet, $titre)
    {


        $mj = new \Mailjet\Client('fcee0ad26db371fc2074a223389e4c54', '217cf5080f4d2ab03095243ce3638952', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                                            'Email' => "notifications@gna-ci.com",
                                            'Name' => "GNA-CI"
                                        ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $nom
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "message" => $messages,
                    ],
                    /*'TemplateID' => 1785911,*/
                   /* 'TemplateLanguage' => true,*/
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }

    public static function get_envoimailTemplateGna($email, $nom, $messages, $sujet, $titre, $contact)
    {


        $mj = new \Mailjet\Client('fcee0ad26db371fc2074a223389e4c54', '217cf5080f4d2ab03095243ce3638952', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "notifications@gna-ci.com",
                        'Name' => "GNA-CI"
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $nom
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "message" => $messages,
                        "contact" => $contact,
                    ],
                    'TemplateID' => 1785911,
                    'TemplateLanguage' => true,
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }


    public static function get_envoimailReclamationTemplate($nom, $messages, $sujet, $titre, $type)
    {


        $mj = new \Mailjet\Client('fcee0ad26db371fc2074a223389e4c54', '217cf5080f4d2ab03095243ce3638952', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "notifications@gna-ci.com",
                        'Name' => "GNA-CI"
                    ],
                    'To' => [
                        [
                            'Email' => "yac.a@hotmail.fr",
                            'Name' => "VICTOIRE IMMOBILIER"
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "type" => $type,
                        "message" => $messages,
                    ],
                    'TemplateID' => 1832735,
                    'TemplateLanguage' => true,
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }

    public static function get_envoimail_gna_assurance(){

        $mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "notifications@gna-ci.com",
                        'Name' => "GNA-CI"
                    ],
                    'To' => [
                        [
                            'Email' => $emailrecept,
                            'Name' => "GNA-ASSURANCE RECEPTION"
                        ]
                    ],
                    'Cc' => [
                        [
                            'Email' => $emailenvoi,
                            'Name' => $emailnom
                        ]
                    ],

                    'Subject' => $sujetps,
                    'TextPart' => "Contact",
                    'HTMLPart' => "zr"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());

    }

    public static function get_envoimail_gna_assurance_newletter($email){

          $mj = new \Mailjet\Client('fcee0ad26db371fc2074a223389e4c54','217cf5080f4d2ab03095243ce3638952',true,['version' => 'v3.1']);
          $data = Logo::where([['flag_logo','=',true],['valeur','=','NEWSLETTER']])->first();
          $body = [
            'Messages' => [
              [
                'From' => [
                  'Email' => "notifications@gna-ci.com",
                  'Name' => "GNA-CI"
                ],
                'To' => [
                  [
                    'Email' => $email,
                    'Name' => "GNA-CI"
                  ]
                ],
                'Subject' => "GNA-CI Newsletter",
                'TextPart' => "",
                'HTMLPart' => $data->mot_cle,
                'CustomID' => "AppGettingStartedTest"
              ]
            ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);
          $response->success() && var_dump($response->getData());


    }

    public static function get_envoimail_gna_assurance_assistance($email, $nom, $messages, $sujet, $contact){

              $mj = new \Mailjet\Client('fcee0ad26db371fc2074a223389e4c54','217cf5080f4d2ab03095243ce3638952',true,['version' => 'v3.1']);
              $data = Logo::where([['flag_logo','=',true],['valeur','=','EMAIL']])->first();
              $messageMail="
                <b>Bonjour  Assistance GNA-CI ,</b>
                                            <br><br>Veuillez trouver ci-après, les information d'un nouveau contact .
                                            <br><br>
                                            <br><b>Nom et prenom : </b> $nom
                                            <br><b>Adresse mail : </b> $email
                                            <br><b>Contact : </b> $contact
                                            <br><b>Sujet : </b> $sujet
                                            <br><b>Message : </b> $messages
                                            <br><br><br>
                                            -----
                                            Ceci est un mail automatique, Merci de ne pas répondre.
                                            -----
                ";
              $body = [
                'Messages' => [
                  [
                    'From' => [
                      'Email' => "notifications@gna-ci.com",
                      'Name' => "GNA-CI"
                    ],
                    'To' => [
                      [
                        'Email' => $data->mot_cle,
                        'Name' => "GNA-CI"
                      ]
                    ],
                    'Subject' => "Nouveau contact",
                    'TextPart' => "Nouveau contact",
                    'HTMLPart' => $messageMail,
                    'CustomID' => "AppGettingStartedTest"
                  ]
                ]
              ];
              $response = $mj->post(Resources::$Email, ['body' => $body]);
              $response->success() && var_dump($response->getData());


        }

}
