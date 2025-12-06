<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Framework extends Model
{
   public function up()
{
    Schema::create('frameworks', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description');
        $table->json('features');
        $table->text('code');
        $table->string('image');
        $table->timestamps();
    });
    
}
public function down(): void
    {
        Schema::dropIfExists('frameworks');
    }
    protected $fillable = ['name', 'slug', 'description'];


}
