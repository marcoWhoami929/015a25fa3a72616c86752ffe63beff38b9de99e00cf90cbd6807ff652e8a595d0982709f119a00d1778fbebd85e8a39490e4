
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};


var productos = ['Pintura Para Trafico Tipo 1 Amarillo',
					'Pistola LVLP',
					'Pistola Para Recubrimiento De Auto Body',
					'Pistola Doble Abanico',
					'Solvente Zaak 626 Para Epoxico',
					'Catalizador Epoxico HD1',
					'Epoxico HD1 As Blanco',
					'Eco Galer Blanco',
					'Artesano 500 Blanco',
					'Cosmo 700 Blanco',
					'Cosmo Plus Blanco',
					'Ultra Body Sw-04 1500',
					'Kit Rts Transparente ECO-SW',
					'Xclo Primer Universal Negro',
					'Xclo Primer Universal Blanco',
					'Xclo Primer Universal Gris',
					'Sherprimer Ng Gris Claro',
					'Endurecedor universal',
					'Endurecedor Para Sherprimer',
					'Reductor Universal Tux 2',
					'Reductor Acrilico END Normal',
					'Xclo Body Filler',
					'Plaster de Piroxilina Auto Gris Claro',
					'Imperial Wetordry 9x11 pul P800',
					'Imperial Wetordry 9x11 pul P600',
					'Imperial Wetordry 9x11 pul P400',
					'Imperial Wetordry 9x11 pul P320',
					'Imperial Wetordry 9x11 pul P220',
					'Imperial Wetordry 9x11 pul P2000',
					'Imperial Wetordry 9x11 pul P1500',
					'Imperial Wetordry 9x11 pul P1200',
					'Imperial Wetordry 9x11 pul P1000',
					'Retenedor Para Filtro 5N11 y 5P71',
					'Respirador Media Cara Tamano Mediano',
					'Filtro Para Particulas Base Agua',
					'Cartucho Para Vapores Organicos',
					'Tela Pegajosa Dynatron Amarillo',
					'Sellador De Uretano Blanco',
					'Rellenador Quick Grip Galon',
					'Rellenador Platinum Select',
					'Superbuff Borla De Lana Doble Cara 9 pul',
					'Respaldo Para Pulidora 5 pul',
					'Perfect It Ultrafina Borla Esponja Azul',
					'Perfect It Borla Esponja Abrillantar Gris 8 pul',
					'Perfect It Borla Esponja Abrillantar 2 Caras',
					'Adaptador Superbuff 3M Para Pulidoras',
					'Adaptador Para Borlas Doble Cara 5-8',
					'3m Removedor De Marcas Econopack',
					'3m Compuesto Pulidor Econopack 225 ml',
					'Perfect It 1',
					'Disco Hookit Trizact P5000 6 pul',
					'Disco Hookit Trizact P3000 6 pul',
					'Disco Hookit Cubitron Ii 282 Perforaciones G80',
					'Disco Hookit Cubitron Ii 282 Perforaciones G220',
					'Disco Hookit Cubitron Ii 282 Perforaciones G180',
					'Disco Hookit Cubitron Ii 282 Perforaciones G150',
					'Disco Hookit Cubitron Ii 282 Perforaciones G120',
					'Pelicula Plastica Amarilla 365 mt',
					'Papel Para Enmascarar Blanco 36 pul',
					'Masking Tape Uso General 3/4 pul',
					'Masking Tape Uso General 2 pul',
					'Covercryl Anticorrosivo Base Agua',
					'Covercryl Anticorrosivo Base Agua 2',
					'Poliuretano Hd1 As Transparente',
					'Zaak Imper 3-1 Fibra Oxido'

			];
$('#buscador .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'productos',
  source: substringMatcher(productos)
});
