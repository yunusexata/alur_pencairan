<?php

namespace Database\Seeders\AlurPencairan;

use App\Models\AlurPencairan\AlurProses;
use App\Models\AlurPencairan\AlurProsesDetail;
use App\Repositories\AlurPencairan\AlurProsesDetailRepository;
use App\Repositories\AlurPencairan\AlurProsesRepository;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AlurProsesSeeder extends Seeder
{
    public function run()
    {

        $alur = AlurProsesRepository::create([
            'name' => AlurProses::TYPE_SPEED_20
        ]);
        foreach (AlurProsesDetail::ALUR_SPEED_20_LIST as $key => $alur_proses) {
            $role = Role::findByName($alur_proses['role_name']);
            $data = [

                'alur_proses_id' => $alur->id,
                'nomor_urut' => $key + 1,
                'name' => $alur_proses['name'],
                'role_name' => $alur_proses['role_name'],
                'role_id' => $role->id,
                'is_multi' => $alur_proses['is_multi'],
                'by_user' => $alur_proses['by_user'],
                'user_id' => $alur_proses['user_id'],
                'alur_proses_key' => $alur_proses['alur_proses_key'],
                'role_can_show' => json_encode($alur_proses['role_can_show']),
            ];

            AlurProsesDetailRepository::create($data);
        };
        $alur = AlurProsesRepository::create([
            'name' => AlurProses::TYPE_NORMAL
        ]);
        foreach (AlurProsesDetail::ALUR_NORMAL_LIST as $key => $alur_proses) {
            $role = Role::findByName($alur_proses['role_name']);
            $data = [

                'alur_proses_id' => $alur->id,
                'nomor_urut' => $key + 1,
                'name' => $alur_proses['name'],
                'role_name' => $alur_proses['role_name'],
                'role_id' => $role->id,
                'is_multi' => $alur_proses['is_multi'],
                'by_user' => $alur_proses['by_user'],
                'user_id' => $alur_proses['user_id'],
                'alur_proses_key' => $alur_proses['alur_proses_key'],
                'role_can_show' => json_encode($alur_proses['role_can_show']),
            ];
            AlurProsesDetailRepository::create($data);
        };
        $alur = AlurProsesRepository::create([
            'name' => AlurProses::TYPE_PROSES_80
        ]);
        foreach (AlurProsesDetail::ALUR_PROSES_80_LIST as $key => $alur_proses) {
            $role = Role::findByName($alur_proses['role_name']);
            $data = [

                'alur_proses_id' => $alur->id,
                'nomor_urut' => $key + 1,
                'name' => $alur_proses['name'],
                'role_name' => $alur_proses['role_name'],
                'role_id' => $role->id,
                'is_multi' => $alur_proses['is_multi'],
                'by_user' => $alur_proses['by_user'],
                'user_id' => $alur_proses['user_id'],
                'alur_proses_key' => $alur_proses['alur_proses_key'],
                'role_can_show' => json_encode($alur_proses['role_can_show']),
            ];

            AlurProsesDetailRepository::create($data);
        };
    }
}
