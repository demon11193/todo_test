<?php
/**
 * Created by PhpStorm.
 * User: demon
 * Date: 22.05.2019
 * Time: 17:41
 */
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Core\View;
use App\Exceptions\NoFindPageException;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

class TaskListController extends Controller
{

    const LIMIT_PER_PAGE = 3;

    function index(Request $request) {
        $page = intval($request->get('page'));
        $sort = $request->get('sort');
        if ($page < 1) {
            $page = 1;
        }
        $query = Task::leftJoin(
            'users',
            'tasks.user_id',
            'users.id'
        );
        $limit = $query->count();
        $maxPage = ceil($limit / self::LIMIT_PER_PAGE);

        switch ($sort) {
            case 'user':
                $query->orderBy('users.login');
                break;
            case 'email':
                $query->orderBy('users.email');
                break;
            case 'status':
                $query->orderBy('is_finished');
                break;
            default:
                $query->orderBy('id');
                break;
        }

        $tasks = $query
            ->limit(self::LIMIT_PER_PAGE)
            ->offset(self::LIMIT_PER_PAGE * ($page - 1))
            ->get('tasks.*');

        View::render(
            'index',
            [
                'tasks' => $tasks,
                'page'  => $page,
                'max_page'  => $maxPage,
                'sort'  => $sort,
            ]
        );
    }

    function show(Request $request, $id = null) {
        if (!is_null($id)) {
            $task = Task::find($id);
            if (!$task) {
                throw new NoFindPageException();
            }
        }
        else {
            $task = new Task();
        }
        View::render(
            'edit',
            ['task' => $task]
        );
    }

    function edit(Request $request, $id = null) {
        if (!is_null($id)) {
            $task = Task::find($id);
            if (!$task) {
                throw new NoFindPageException();
            }
        }
        else {
            $task = new Task();
            if (Auth::hasAuth()) {
                $task->user_id = Auth::getUserId();
            }
        }
        $task->content = $request->post('content');
        $task->is_finished = !!$request->post('is_finished');
        $task->save();
        $this->redirectTo('/tasks/' . $task->id);
    }

    /**
     * Проверяет есть ли доступ у пользователя к методу
     *
     * @param Request $request
     * @param string $methodName
     * @param array $params
     * @return bool
     */
    static function hasAccess(Request $request, string $methodName, array $params):bool {
        if (in_array($methodName, ['show', 'edit'])) {
            if (!empty($params['id'])) {
                return Auth::hasAuth();
            }
        }
        return true;
    }

}