<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Kalnoy\Nestedset\NodeTrait;
use Laracasts\Presenter\PresentableTrait;


class Page extends Model
{
    use HasFactory;

    use NodeTrait;
    use PresentableTrait;

    protected $presenter = 'App\Presenters\PagePresenter';

    protected $table = 'pages';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
            'title',
            'url',
            'content',
            'user_id',
            '_parent_id',
            '_lft',
            '_rgt'
        ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function updateOrder($order, $orderPage){
        $relative = Page::findOrFail($orderPage);

        if($order == 'before'){
            $this->beforeNode($relative)->save();
        } else if ($order == 'after'){
            $this->afterNode($relative)->save();
        } else {
            $relative->appendNode($this);
        }

        Page::fixTree();
    }
}
