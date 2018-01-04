<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 02/06/2017
 * Time: 10:41
 */

namespace AppBundle\Services;

use AppBundle\Entity\CultureFit;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use UserBundle\Entity\User;


/**
 * Class Api
 *
 * @package AppBundle\Services
 */
class Api
{
    const perPage = 100;
    const mobility = 'Mobilité Géographique';
    const wanted_job = 'Poste voulu';
    const experience = 'Expérience';
    const remuAvt = "Rémunération & Avantages";
    const formEvo = "Evolution professionnelle";
    const recoMgt = "Reconnaissance & Management";
    const exp = "Savoir-faire & Expertise";
    const respCha = "Responsabilité & Challenge";
    const devEga = "Impact sociétal de l'entreprise";
    const creaInno = "Créativité & Innovation";
    const teamAmb = "Travail en équipe & Ambiance";
    private $apiUrl;
    private $apiKey;
    private $client;
    private $portalId;
    private $em;

    /**
     * @return mixed
     */
    public function getPortalId()
    {
        return $this->portalId;
    }

    /**
     * @param mixed $portalId
     * @return Api
     */
    public function setPortalId($portalId)
    {
        $this->portalId = $portalId;
        return $this;
    }

    /**
     * Api constructor.
     */
    public function __construct($apiUrl, $apiKey, $portalId, EntityManager $entityManager)
    {
        $this->setApiKey($apiKey)->setApiUrl($apiUrl)->setPortalId($portalId)->setEm
    ($entityManager)->setClient(new Client(['base_uri' => $this->getApiUrl()]));
    }

    /**
     * @return mixed
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param mixed $em
     * @return Api
     */
    public function setEm($em)
    {
        $this->em = $em;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param mixed $apiUrl
     * @return Api
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     * @return Api
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     * @return Api
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }


    public function updateCandidatefromCats(User $user, $userData)
    {
        $user->setFirstName($userData->first_name);
        $user->setLastName($userData->last_name);
        $user->setTitle($userData->title);
        $user->setEmail($userData->emails->primary);
        $user->setPhone($userData->phones->cell);
        $user->setSalary($userData->current_pay);
        $user->setWantedSalary($userData->desired_pay);
        foreach ($userData->_embedded->custom_fields as $field) {
            if ($field->_embedded->definition->name == self::mobility) {
                $user->setMobility($field->value);

                $regions = array();
                foreach ($field->_embedded->definition->field->selections as $region){
                    $regions[$region->label] = $region->id;
                }
                $regions = array_flip($regions);

                $mobilities = array();
                foreach ($field->value as $mobility) {
                    $mobilities[] = $regions[$mobility];
                }
                $user->setMobilityName($mobilities);
            } else if ($field->_embedded->definition->name == self::wanted_job) {
                $user->setWantedJob($field->value);
            } else if ($field->_embedded->definition->name == self::experience) {
                $user->setExperience($field->value);
            }
        }
        $this->getEm()->persist($user);
        $this->getEm()->flush();
        return $user;
    }

    public function getJob()
    {
        $data = $this->getClient()->request(
            'GET', 'portals/'.$this->getPortalId().'/jobs'.'?per_page='.self::perPage, [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        $data = json_decode($data->getBody()->getContents());
        $jobs = $data->_embedded->jobs;

        return $jobs;
    }

    public function getId($query, $id)
    {
        $data = $this->getClient()->request(
            'GET', $query . '/' . $id, [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        return json_decode($data->getBody()->getContents());
    }


    public function getSearch($query, $search)
    {
        $data = $this->getClient()->request(
            'GET', $query . '/search?query=' . $search, [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'field' => 'emails.primary',

                ]
            ]
        );
        return json_decode($data->getBody()->getContents());
    }

    public function getRegions()
    {

        $fields = $this->candidateCustomFields();
        $regions = array();
        foreach ($fields as $field) {
            if ($field->name == self::mobility) {
                foreach ($field->field->selections as $region){
                    $regions[$region->label] = $region->id;
                }
                break;
            }
        }
        return $regions;
    }

    public function candidateCustomFields()
    {
        $customFields = $this->getClient()->request(
            'GET', 'candidates/custom_fields', [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'content-type' => 'application/json'
                ],
            ]
        );
        return json_decode($customFields->getBody()->getContents())->_embedded->custom_fields;
    }

    public function createCandidateUser(User $user)
    {
        $fields = $this->candidateCustomFields();
        $customFields = [];
        $value = '';
        foreach ($fields as $field) {
            if ($field->name == self::mobility) {
                $value = array();
                foreach ($user->getMobility() as $mobility){
                    $value[] = $mobility;
                }
            } else if ($field->name == self::wanted_job) {
                $value = $user->getWantedJob();
            } else if ($field->name == self::experience) {
                $value = $user->getExperience();
            } else if ($field->name == self::remuAvt) {
                $value = '0/10';
            } else if ($field->name == self::formEvo) {
                $value =  '0/10';
            } else if ($field->name == self::recoMgt) {
                $value = '0/10';
            } else if ($field->name == self::exp) {
                $value = '0/10';
            } else if ($field->name == self::respCha) {
                $value = '0/10';
            } else if ($field->name == self::devEga) {
                $value = '0/10';
            } else if ($field->name == self::creaInno) {
                $value = '0/10';
            } else if ($field->name == self::teamAmb) {
                $value = '0/10';
            }
            $customFields[] = ['id' => $field->id, 'value' => $value];
        }
        $candidate = $this->getClient()->request(
            'POST', 'candidates?check_duplicate=true', [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'content-type' => 'application/json'
                ],
                'json' => [
                    "first_name" => $user->getFirstname(),
                    "last_name" => $user->getLastname(),
                    "emails" => [
                        "primary" => $user->getEmail()
                    ],
                    "title" => $user->getTitle(),
                    "current_pay" => $user->getSalary(),
                    "desired_pay" => $user->getWantedSalary(),
                    "phones" => [
                        "cell" => $user->getPhone()
                    ],
                    "custom_fields" => $customFields
                ]

            ]
        );
        return $candidate;
    }

    public function deleteCandidate($id)
    {
        $data = $this->getClient()->request(
            'DELETE', 'candidates/' . $id, [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey()
                ]
            ]
        );
        return json_decode($data->getBody()->getContents());
    }


    public function sendResume($file, $id, $firstName, $lastName, $origin)
    {
        $for = (array) $file;
        $result='';
        $format='.txt';

        foreach ($for as $value ){
            $result .= '*'.$value;
        }

        if ($origin === 'CV') {
            $resultTab = explode('*', $result);
            $format = $resultTab[2];

            $resume = $this->getClient()->request(
                'POST', 'candidates/' . $id . '/resumes?filename='.$firstName.'-'.$lastName.'-'.$format.'', [
                    'headers' => [
                        'Authorization' => 'Token ' . $this->getApiKey(),
                        'content-type' => 'application/octet-stream'
                    ],

                    'body' => fopen(realpath($file), 'r')
                ]
            );
        }

        if ($origin === 'Big5') {
            $resultTab = explode('/', $result);
            $format = $resultTab[sizeof($resultTab) - 1];

            $resume = $this->getClient()->request(
                'POST', 'candidates/' . $id . '/resumes?filename=' . $firstName . '-' . $lastName . '-' . $format . '', [
                    'headers' => [
                        'Authorization' => 'Token ' . $this->getApiKey(),
                        'content-type' => 'application/octet-stream'
                    ],

                    'body' => fopen($file, 'r')
                ]
            );
        }

        return $resume;
    }

    public function updateCandidate(User $user, $catsUser, $cultureFit)
    {
        $fields = $this->candidateCustomFields();
        $customFields = [];
        $value = '';
        if ($cultureFit != null) {
            foreach ($fields as $field) {
                if ($field->name == self::mobility) {
                    $value = array();
                    foreach ($user->getMobility() as $mobility) {
                        $value[] = $mobility;
                    }
                } else if ($field->name == self::wanted_job) {
                    $value = $user->getWantedJob();
                } else if ($field->name == self::experience) {
                    $value = $user->getExperience();
                } else if ($field->name == self::remuAvt) {
                    $value = $cultureFit->getRemuAvt() . '/10';
                } else if ($field->name == self::formEvo) {
                    $value = $cultureFit->getFormEvo() . '/10';
                } else if ($field->name == self::recoMgt) {
                    $value = $cultureFit->getRecoMgt() . '/10';
                } else if ($field->name == self::exp) {
                    $value = $cultureFit->getExp() . '/10';
                } else if ($field->name == self::respCha) {
                    $value = $cultureFit->getRespCha() . '/10';
                } else if ($field->name == self::devEga) {
                    $value = $cultureFit->getDevEga() . '/10';
                } else if ($field->name == self::creaInno) {
                    $value = $cultureFit->getCreaInno() . '/10';
                } else if ($field->name == self::teamAmb) {
                    $value = $cultureFit->getTeamAmb() . '/10';
                }
                $customFields[] = ['id' => $field->id, 'value' => $value];
            }
        } else {
            foreach ($fields as $field) {
                if ($field->name == self::mobility) {
                    $value = array();
                    foreach ($user->getMobility() as $mobility) {
                        $value[] = $mobility;
                    }
                } else if ($field->name == self::wanted_job) {
                    $value = $user->getWantedJob();
                } else if ($field->name == self::experience) {
                    $value = $user->getExperience();
                }else if ($field->name == self::remuAvt) {
                    $value = '0/10';
                } else if ($field->name == self::formEvo) {
                    $value = '0/10';
                } else if ($field->name == self::recoMgt) {
                    $value = '0/10';
                } else if ($field->name == self::exp) {
                    $value = '0/10';
                } else if ($field->name == self::respCha) {
                    $value = '0/10';
                } else if ($field->name == self::devEga) {
                    $value = '0/10';
                } else if ($field->name == self::creaInno) {
                    $value = '0/10';
                } else if ($field->name == self::teamAmb) {
                    $value = '0/10';
                }

                $customFields[] = ['id' => $field->id, 'value' => $value];
            }
        }
        $update = $this->getClient()->request(
            'PUT', 'candidates/' . $catsUser, [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'content-type' => 'application/octet-stream'
                ],
                'json' => [
                    "first_name" => $user->getFirstname(),
                    "last_name" => $user->getLastname(),
                    "emails" => [
                        "primary" => $user->getEmail()
                    ],
                    "title" => $user->getTitle(),
                    "current_pay" => $user->getSalary(),
                    "desired_pay" => $user->getWantedSalary(),
                    "phones" => [
                        "cell" => $user->getPhone()
                    ],
                    "custom_fields" => $customFields
                ]
            ]
        );
        return $update;
    }

    public function apply($userId, $jobId)
    {
        $apply = $this->getClient()->request(
            'POST', 'pipelines',
            [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'content-type' => 'application/json'
                ],
                'body' => '{"candidate_id": ' . $userId . ',"job_id": ' . $jobId . '}'
            ]
        );
        return $apply;
    }

    public function downloadImg($job)
    {
        $list = glob("img/jobPicture/$job.*");
        if (!isset($list[0])) {
            $download = $this->getClient()->request(
                'GET', 'attachments/' . $job . '/download',
                [
                    'headers' => [
                        'Authorization' => 'Token ' . $this->getApiKey(),
                    ],
                ]
            );
            $img = file_put_contents('img/jobPicture/' . $job, $download->getBody()->getContents());
            $mime = mime_content_type('img/jobPicture/' . $job);


            $val = [
                'image/jpeg',
                'image/gif',
                'image/png',
                'image/jpg',
            ];

            if (in_array($mime, $val)) {

                $ext = str_replace('image/', '.', $mime);
                $fileName = $job . $ext;
                rename('img/jobPicture/' . $job, 'img/jobPicture/' . $fileName);
                return $fileName;

            } else {
                unlink('img/jobPicture/' . $job);
            }

        } else {
            return basename($list[0]);
        }
    }


    public function tagCandidate($candidate, $tag)
    {
        $tag = $this->getClient()->request(
            'PUT', 'candidates/' . $candidate . '/tags', [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    "tags" => [
                        ["id" => $tag]
                    ]
                ]
            ]
        );
        return $tag;
    }

    public function getTag()
    {
        $tags = $this->getClient()->request(
            'GET', 'tags', [
                'headers' => [
                    'Authorization' => 'Token ' . $this->getApiKey(),
                    'Content-Type' => 'application/json'
                ]
            ]
        );
        $tags = json_decode($tags->getBody()->getContents());
        return $tags;
    }

}

