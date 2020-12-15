<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'metadata',
        'featured_media'
    ];
    protected $casts = [
        'metadata' => 'json'
    ];

    public static function fromWpProperty($property)
    {
        $instance = Property::findOrNew(data_get($property,'id'));
        $instance->fill($property);
        $instance->assignRendered('title',data_get($property,'title'));
        $instance->assignRendered('content',data_get($property,'content'));
        $instance->assignRendered('excerpt',data_get($property,'excerpt'));
        $instance->save();
        return $instance;
    }

    /**
     * assign rendered value from WP response
     *
     * @param string $key
     * @param $data
     */
    public function assignRendered(string $key, $data)
    {
        $this->$key = data_get($data,'rendered');
    }
}
