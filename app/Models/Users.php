<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'usr_id';
    public $timestamps = false;
    public $incrementing = false;

    public static function authenticate(array $credentials)
    {
        $user = self::where('usr_email', $credentials['email'])->with('role')->first();
        if(!$user || !Hash::check($credentials['password'], $user->usr_password))
        {
            return null;
        }

        return $user;
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'rl_id', 'rl_id');
    }

    public function menus(string $rlid)
    {
        $menus = [];
        $sub_menus = [];
        $role_menus = RoleMenus::where('rl_id', $rlid)->get();
        foreach($role_menus as $role_menu)
        {
            $role_sub_menus = RoleSubMenus::where('rlmn_id', $role_menu->rlmn_id)->get();
            foreach($role_sub_menus as $role_sub_menu)
            {
                $sub = SubMenus::find($role_sub_menu->sbmn_id);
                $sub_menus[$sub->sbmn_reference] = [
                    'detail' => $sub->sbmn_detail,
                    'icon' => $sub->sbmn_icon,
                    'reference' => $sub->sbmn_reference,
                    'menu' => $sub->sbmn_menu,
                    'class' => $sub->sbmn_class,
                    'can' => [
                        'create' => $sub->sbmn_create,
                        'update' => $sub->sbmn_update,
                        'destroy' => $sub->sbmn_destroy,
                        'view' => $sub->sbmn_view,
                    ],
                ];
            }

            $menu = Menus::find($role_menu->mn_id);
            $menus[$menu->mn_prefix] = [
                'detail' => $menu->mn_detail,
                'icon' => $menu->mn_icon,
                'branched' => $menu->mn_branched,
                'reference' => $menu->mn_reference,
                'subs' => $sub_menus,
            ];
        }

        return $menus;
    }
}
