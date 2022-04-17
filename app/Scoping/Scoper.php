<?php
namespace App\Scoping;

use App\Scoping\Contracts\ScopeInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Scoper
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, array $scopes)
    {
        foreach ($scopes as $key => $scope) {
            if (!$scope instanceof ScopeInterface) {
                continue;
            }
            $scope->apply($builder, $this->request->get($key));
        }
    }
}
