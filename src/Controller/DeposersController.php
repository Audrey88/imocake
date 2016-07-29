<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class DeposersController extends AppController
{
    public function index()
    {
        $ad = TableRegistry::get('type_ads');
        $ads = $ad->find('list');
        $this->set(compact('ads'));
//$cities = TableRegistry::get('towns');
//$cities_list = $cities->find();
//        $cities = array();
//        foreach ($cities_list as $city) {
//            $cities[] = $city->town_name;
//        }
//
//
//        $this->set('cities', $cities);
    }

    public function submit()
    {
        $NewUser = TableRegistry::get('Ads');
        $CreatedUser = $NewUser->newEntity();

        $cities = TableRegistry::get('Towns');
        $cit =  $this->request->data['city'];

        $city = $cities->find()->select(['id'])->where(['town_name' => $cit])->first();

        $id_city =$city['id'];


        $user = 1;

        if ($this->request->data['select'] == 1) {
            $sale = 1;
            $rent = 0;
        }
        if ($this->request->data['select'] == 2) {
            $sale = 0;
            $rent = 1;
        }
        if ($this->request->data['select'] == 3) {
            $sale = 1;
            $rent = 1;
        }

        $CreatedUser->town_id = $id_city;
        $CreatedUser->for_rent = $rent;
        $CreatedUser->for_sale = $sale;
        $CreatedUser->user_id = $user;
        $CreatedUser->type_ad_id = $this->request->data['type_ad_id'];
        $CreatedUser->price = $this->request->data['price'];
        $CreatedUser->price_info = $this->request->data['price_info'];
        $CreatedUser->surface = $this->request->data['surface'];
        $CreatedUser->description = $this->request->data['description'];
        $CreatedUser->is_divisible = $this->request->data['is_divisible'];
        $CreatedUser->latitude = $this->request->data['latitude'];
        $CreatedUser->longitude = $this->request->data['longitude'];
        $NewUser->save($CreatedUser);

    }
}


