<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAdditionally;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserService
{
    private int $usersOnPage = 6;
    private TinifyService $tinifyService;

    public function __construct(TinifyService $tinifyService)
    {
        $this->tinifyService = $tinifyService;
    }

    public function getLimit(array $request): Collection
    {
        $page = $request['page'] ?? 1;
        $limit = $page * 6;

        return User::query()->with(['additionally', 'position'])->orderByDesc('id')->limit($limit)->get();
    }

    public function view(int $id): Builder|array|Collection|Model
    {
        return User::query()->find($id);
    }

    public function getPage(): int
    {
        $countUsers = User::query()->count();
        $pages = intval(ceil($countUsers / $this->usersOnPage));
        $currentPage = request('page') ?? 1;

        if($pages == $currentPage) {
            $currentPage = request('page');
        } else {
            $currentPage = ++$currentPage;
        }

        return $currentPage;
    }

    public function save(array $data): void
    {
        $fillDataAdditionally = Arr::only($data, ['phone']);
        $fillData = Arr::only($data, ['name', 'email', 'position_id', 'password']);

        $user = DB::transaction(function () use ($fillDataAdditionally, $fillData) {
            $userAdditionally = UserAdditionally::query()->create($fillDataAdditionally);
            $fillData['additionally_id'] = $userAdditionally->id;
            return User::query()->create($fillData);
        });

        $userAdditionallyID = (int) data_get($user, 'additionally.id');

        if ($userAdditionallyID > 0 && !empty($data['photo'])) {
            $this->tinifyService->upload($data['photo'], $userAdditionallyID);
        }
    }
}
