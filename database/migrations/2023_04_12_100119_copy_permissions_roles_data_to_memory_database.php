<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::connection('sqlite')->table('roles')->truncate();
        DB::connection('sqlite')->table('permissions')->truncate();
        DB::connection('sqlite')->table('model_has_permissions')->truncate();
        DB::connection('sqlite')->table('model_has_roles')->truncate();
    
        $roles = DB::table('roles')->get();
        $permissions = DB::table('permissions')->get();
        $model_has_permissions = DB::table('model_has_permissions')->get();
        $model_has_roles = DB::table('model_has_roles')->get();
    
        foreach ($roles as $role) {
            DB::connection('sqlite')->table('roles')->insert((array) $role);
        }
    
        foreach ($permissions as $permission) {
            DB::connection('sqlite')->table('permissions')->insert((array) $permission);
        }
    
        foreach ($model_has_permissions as $model_has_permission) {
            DB::connection('sqlite')->table('model_has_permissions')->insert((array) $model_has_permission);
        }
    
        foreach ($model_has_roles as $model_has_role) {
            DB::connection('sqlite')->table('model_has_roles')->insert((array) $model_has_role);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('memory_database', function (Blueprint $table) {
            //
        });
    }
};
