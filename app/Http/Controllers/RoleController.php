<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Roles;

class RoleController extends Controller
{
    private $root = 'sttng';
    private $default_route = 'rl.index';

    public function index(Request $request)
    {
        // validattion for search engine
        $inputs = $request->validate([
            'search' => 'nullable|string',
        ]);

        if(empty($inputs['search']) && isset($request['search']))
        {
            return redirect()->route($this->default_route);
        }

        // get list
        $search = isset($inputs['search']) ? $inputs['search'] : '';
        $roles = Roles::where('rl_deleted', 0);
        if(!empty($inputs['search']))
        {
            $roles = Roles::where('rl_deleted', 0)->whereRaw('rl_detail like ?', '%'.$search.'%');
        }

        // Generate data
        $data = [
            'paginate' => $roles->paginate(),
            'start' => isset($request['page']) ? (($request['page'] * $roles->paginate()->total()) != 0 ? $request['page'] * $roles->paginate()->total() : 1) : 1,
            'count' => $roles->paginate()->total(),
            'max' => $roles->count(),
            'roles' => $roles->get(),
        ];

        return $this->render('index', $data, $search);
    }

    public function create(Request $request)
    {
        $inputs = $request->validate([
            'detail' => 'required|string|unique:tbl_roles,rl_detail',
            'level' => 'numeric|nullable',
        ]);

        try
        {
            // 3 = Generate menu id
            $id = $this->generateID(1);

            $role = new Roles();
            $role->rl_id = $id;
            $role->rl_detail = $inputs['detail'];
            $role->rl_level = $inputs['level'];
            $role->save();

            return redirect()->route($this->default_route)->with('message', $this->successMessage());
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function update(Request $request)
    {
        $inputs = $request->validate([
            'detail' => 'required|string',
            'level' => 'numeric|nullable',
            'id' => 'required|string',
        ]);

        try
        {
            // Validate menu
            $role = Roles::whereRaw('md5(rl_id) = ?', $inputs['id'])->where('rl_deleted', 0)->first();
            if(!$role)
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            // Save
            $role->rl_detail = $inputs['detail'];
            $role->rl_level = $inputs['level'];
            $role->save();

            return redirect()->route($this->default_route)->with('message', $this->successMessage('Record has been updated.'));
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function destroy(Request $request)
    {
        $inputs = $request->validate([
            'delete' => 'required',
        ]);

        try
        {
            $role = Roles::where('rl_deleted', 0)->whereRaw('md5(rl_id) = ?', $inputs['delete'])->first();
            if(!$role)
            {
                return redirect()->route($this->default_route)->with('message', $this->warningMessage());
            }

            $role->rl_deleted = 1;
            $role->save();

            return redirect()->route($this->default_route)->with('message', $this->successMessage('Record has been deleted.'));
        }
        catch(Exception $e)
        {
            return redirect()->route($this->default_route)->with('message', $this->dangerMessage());
        }
    }

    public function render(string $page, array $records = [], string $search = '')
    {
        $data = [
            's_menu' => $this->root,
            's_submenu' => $this->getSubMenu($this->root, $page, 'rl'),
            'records' => $records,
            'search' => $search,
        ];
        return view('pages.roles.'.$page, $data);
    }
}
