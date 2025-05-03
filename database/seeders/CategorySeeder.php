<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Électronique', 'description' => 'Téléphones, ordinateurs, gadgets...'],
            ['name' => 'Mode Homme', 'description' => 'Vêtements, chaussures, accessoires homme.'],
            ['name' => 'Mode Femme', 'description' => 'Vêtements, sacs, bijoux, chaussures femme.'],
            ['name' => 'Maison & Cuisine', 'description' => 'Meubles, électroménager, ustensiles.'],
            ['name' => 'Beauté & Soins', 'description' => 'Parfums, maquillage, soins du corps.'],
            ['name' => 'Sport & Fitness', 'description' => 'Équipements de sport, vêtements, nutrition.'],
            ['name' => 'Bébé & Enfants', 'description' => 'Vêtements, jouets, accessoires, couches.'],
            ['name' => 'Santé', 'description' => 'Matériel médical, compléments, produits pharma.'],
            ['name' => 'Auto & Moto', 'description' => 'Pièces détachées, accessoires, entretien.'],
            ['name' => 'Informatique', 'description' => 'PC, composants, périphériques.'],
            ['name' => 'Jeux Vidéo', 'description' => 'Consoles, jeux, accessoires gamer.'],
            ['name' => 'Livres', 'description' => 'Romans, manuels, livres scolaires.'],
            ['name' => 'Jardin & Bricolage', 'description' => 'Outils, mobilier d’extérieur, entretien.'],
            ['name' => 'Alimentation', 'description' => 'Épicerie, boissons, produits frais.'],
            ['name' => 'Téléphonie', 'description' => 'Smartphones, accessoires, recharge.'],
            ['name' => 'Montres & Bijoux', 'description' => 'Montres, colliers, bracelets, bagues.'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
