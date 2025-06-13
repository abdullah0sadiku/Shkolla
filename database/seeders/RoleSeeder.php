<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_drejtori = Role::create(['name'=>'Drejtor']);
        $role_mesuesi = Role::create(['name'=>'Mesuesi']);
        $role_studenti = Role::create(['name'=>'Studenti']);
        $role_admini = Role::create(['name'=>'Admin']);

        // Keto jan rolet baz ne sicilin do aplikacion.
        $permission_lexim = Permission::create(['name'=>'lexim']);
        $permission_modifikim = Permission::create(['name'=>'modifikim']);
        $permission_shkrim = Permission::create(['name'=>'shkrim']);
        $permission_fshij = Permission::create(['name'=>'fshij']);
        
        // Keto jan rolet per perpunimin me klasa mesimore 
        $permission_krijo_klasa = Permission::create(['name'=>'krijo_klas']);
        $permission_modifiko_klasa = Permission::create(['name'=>'modifiko_klas']);
        $permission_fshij_klasa = Permission::create(['name'=>'fshij_klas']);
        $permission_lexo_klasa = Permission::create(['name'=>'lexo_klas']);
        
        // Keto jan rolet per krijimin e perdoruesve
        $permission_shto_student = Permission::create(['name'=>'shto_student']);
        $permission_shto_mesues = Permission::create(['name'=>'shto_mesues']);

        // Keto jan rolet per Pagat !!
        $permission_shto_pag = Permission::create(['name'=>'shto_pag']);
        $permission_lexo_pag = Permission::create(['name'=>'lexo_pag']);
        $permission_modifiko_pag = Permission::create(['name'=>'modifiko_pag']);

        $drejtori_permissions =[$permission_fshij , $permission_lexim , $permission_modifikim , $permission_shkrim , $permission_krijo_klasa , $permission_lexo_klasa , $permission_fshij_klasa , $permission_modifiko_klasa , $permission_shto_mesues , $permission_shto_student , $permission_shto_pag , $permission_lexo_pag , $permission_modifiko_pag];
        
        $mesuesi_permissions =[$permission_lexim , $permission_modifikim , $permission_shkrim];

        $student_permissions =[$permission_lexim];

        $admin_permissions =[$permission_fshij , $permission_lexim , $permission_modifikim , $permission_shkrim , $permission_krijo_klasa , $permission_lexo_klasa , $permission_fshij_klasa , $permission_modifiko_klasa , $permission_shto_mesues , $permission_shto_student];
        

        $role_drejtori->syncpermissions($drejtori_permissions);
        $role_mesuesi->syncpermissions($mesuesi_permissions);
        $role_studenti->syncpermissions($student_permissions);
        $role_admini->syncpermissions($admin_permissions);
    }
}
