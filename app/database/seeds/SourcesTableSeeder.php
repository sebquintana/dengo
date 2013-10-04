<?php

class SourcesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('sources')->truncate();
		$sources = array(
			['Name' => '436c6172c3ad6e', 'ShortName' => 'clarin', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '4c61204e616369c3b36e', 'ShortName' => 'lanacion', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'Infonews', 'ShortName' => 'Infonews', 'Type' => 'portal', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '4c612052617ac3b36e', 'ShortName' => 'larazon', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'MinutoUno', 'ShortName' => 'MinutoUno', 'Type' => 'portal', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '50c3a167696e61203132', 'ShortName' => 'pagina12', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '54c3a96c616d', 'ShortName' => 'telam', 'Type' => 'portal', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'Infobae', 'ShortName' => 'Infobae', 'Type' => 'portal', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '4372c3b36e696361', 'ShortName' => 'cronica', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'c3816d6269746f2046696e616e636965726f', 'ShortName' => 'ambito', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '456c2061746cc3a16e7469636f', 'ShortName' => 'elatlantico', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'La Capital de Rosario', 'ShortName' => 'lacapital', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => '4f6cc3a9', 'ShortName' => 'ole', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'El Espectador Mundo', 'ShortName' => 'elespectador', 'Type' => 'internacional', 'Genre' => 'null', 'Country' => 'Venezuela'],
			['Name' => '456c205061c3ad73', 'ShortName' => 'elpais', 'Type' => 'internacional', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'Perfil', 'ShortName' => 'perfil', 'Type' => 'diario', 'Genre' => 'null', 'Country' => 'Argentina'],
			['Name' => 'La Voz', 'ShortName' => 'lavoz', 'Type' => 'provincial', 'Genre' => 'null', 'Country' => 'Argentina']
		);

		DB::table('sources')->insert($sources);
	}

}
