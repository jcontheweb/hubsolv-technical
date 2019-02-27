<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property string $author
 * @property-write float $price
 * @property-read string $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read array $categories
 * @method static void ofCategory($query, $category)
 */
class Book extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getPriceAttribute()
    {
        return $this->attributes['price'] . ' GBP';
    }

    public function setCategoriesAttribute($categories)
    {
        collect($categories)->each(function ($category) {
            $category = strcasecmp($category, 'php') === 0 ? 'PHP' : Str::studly($category);
            $this->categories()->firstOrCreate(['name' => $category]);
        });
    }

    public function scopeOfCategory($query, $category)
    {
        if ($category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', Str::studly($category));
            });
        }
    }
}
