<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Fetch category IDs from the categories table
          $categories = DB::table('categories')->get();

          // Define subcategory values for each category
          $subcategories = [
              // Category 1: Administrative and Support Services
              1 => [
                ['value' => 'Home and office removal services'],
                ['value' => 'Home and office support activities including cleaning'],
                ['value' => 'Hospitality and event management'],
                ['value' => 'Human Resources and Support'],
                ['value' => 'Lead Generation and sales support activities'],
                ['value' => 'Management Consultancy'],
                ['value' => 'Payroll Services'],
                ['value' => 'Recruitment'],
                ['value' => 'Security and investigation activities'],
                ['value' => 'Travel agency and tour operators'],
                  // Add more subcategories as needed
              ],
              // Category 2: Adult & Dating Services
              2 => [
                ['value' => 'Adult Content Creation & Management'],
                ['value' => 'Adult Online Media Platforms'],
                ['value' => 'Gentleman\'s Clubs and Lapdancing Bars'],
                ['value' => 'Online Dating services'],
                ['value' => 'Other Adult Services including Membership organisations'],
                  // Add more subcategories as needed
              ],
              3 => [
                ['value' => 'Farming (including trade of livestock, plant and cereal production)'],
                ['value' => 'Fishing and aquaculture'],
                ['value' => 'Forestry and logging'],
                  // Add more subcategories as needed
              ],
              4 => [
                ['value' => 'Airlines'],
                ['value' => 'Financing of aircraft'],
                ['value' => 'Hire or charter of aircraft'],
                ['value' => 'Military aircraft'],
                ['value' => 'Operational expenses of aircraft'],
                ['value' => 'Repair of aircraft'],
                ['value' => 'Sale or purchase of aircraft or Aircraft parts (Airliners, jets,commercial aircraft)'],
                ['value' => 'Sale or purchase of aircraft or Aircraft parts (General aviation/light aircraft)'],
                  // Add more subcategories as needed
              ],
              5 => [
                ['value' => 'Activities of membership organisations'],
                ['value' => 'Football and other sporting clubs'],
                ['value' => 'Libraries, archives, museums and other cultural activities'],
                ['value' => 'Provision of other recreation activities'],
                ['value' => 'Sports Management and Consultancy'],
                ['value' => 'Theatres and Performing Arts Clubs'],
                  // Add more subcategories as needed
              ],
              6 => [
                ['value' => 'Accountancy'],
        ['value' => 'ATM Operators'],
        ['value' => 'Banks (EEA only), Personal/Business Banking'],
        ['value' => 'Commodity Brokers (except fossil fuels)'],
        ['value' => 'Credit Providers (including Consumer Credit and Payday Loan Companies)'],
        ['value' => 'Credit Repair and Counseling Companies'],
        ['value' => 'Financial advisory services'],
        ['value' => 'Fund Manager / Administrator'],
        ['value' => 'Holding company - not part of a corporate group'],
        ['value' => 'Holding company - part of a corporate group'],
        ['value' => 'Insurance and Reinsurance'],
        ['value' => 'Investments - Regulated'],
        ['value' => 'Investments - Unregulated'],
        ['value' => 'Money Service Business'],
        ['value' => 'Money Service Business - operational expenses'],
        ['value' => 'Pensions'],
        ['value' => 'Regulated Peer to Peer and Crowdfunding Lending'],
        ['value' => 'Retail Banking'],
        ['value' => 'Trade Finance'],
        ['value' => 'Wealth management'],
                  // Add more subcategories as needed
              ],
              7 => [
                ['value' => 'Breeding and Sale of Dogs/Cats'],
                ['value' => 'Breeding and Sale of Horses'],
                ['value' => 'Breeding and Sale of other Domestic Animals'],
                // Add more subcategories as needed
            ],
            8 => [
                ['value' => 'CBD Products including associated investment activities'],
        ['value' => 'Recreational drug paraphernalia'],
        ['value' => 'Retail and manufacture of CBD products'],
        ['value' => 'Retail and manufacture of tobacco products'],
        ['value' => 'Retail of Vapes, E-Cigarettes & Associated products (Including vape liquid)'],
        ['value' => 'Technical services relating to CBD retail including lab testing'],
        ['value' => 'Tobacco cultivation'],
                // Add more subcategories as needed
            ],
            9 => [
                ['value' => 'Activities of holding company'],
                ['value' => 'Non regulated'],
                ['value' => 'Operational expenses'],
                ['value' => 'Payment Agents'],
                ['value' => 'Regulated'],
                // Add more subcategories as needed
            ],
            10 => [
                ['value' => 'Church or Religious organisation'],
                ['value' => 'NGO'],
                ['value' => 'Non regulated charity'],
                ['value' => 'Not for profit'],
                ['value' => 'Regulated charity'],
                ['value' => 'Scout Council'],
                // Add more subcategories as needed
            ],
            11 => [
                ['value' => 'Bricklayer'],
        ['value' => 'Building Surveyor'],
        ['value' => 'Carpenter and Joinery'],
        ['value' => 'Carpet fitter and floor layer'],
        ['value' => 'Construction of buildings'],
        ['value' => 'Demolition'],
        ['value' => 'Electrician'],
        ['value' => 'Gas and Heating Technician'],
        ['value' => 'Glazier / Window fitter'],
        ['value' => 'Landscape Gardener'],
        ['value' => 'Painter and decorator'],
        ['value' => 'Plasterer'],
        ['value' => 'Plumber'],
        ['value' => 'Quantity surveyor'],
        ['value' => 'Roofer'],
        ['value' => 'Scaffolder'],
        ['value' => 'Shopfitter'],
        ['value' => 'Stonemason'],
        ['value' => 'Tiler'],
        ['value' => 'Welder'],
                // Add more subcategories as needed
            ],
            12 => [
                ['value' => 'Non-Financial related Crypto Software'],
                ['value' => 'Crypto currency exchange'],
                ['value' => 'Crypto related Blockchain technology'],
                ['value' => "NFT's (operational expenses only)"],
                ['value' => 'Other related services'],
                // Add more subcategories as needed
            ],
            13 => [
                ['value' => 'Educational support services'],
                ['value' => 'Higher education'],
                ['value' => 'Online education'],
                ['value' => 'Pre-primary/Nursery education'],
                ['value' => 'Primary education'],
                // Add more subcategories as needed
            ],
            14 => [
                ['value' => 'Carbon Offsetting'],
                ['value' => 'Consultancy and Brokerage - Fossil Fuels'],
                ['value' => 'Consultancy and Brokerage - Renewable Energy'],
                ['value' => 'Fuel extraction including oil and gas'],
                ['value' => 'Refining of fuels'],
                ['value' => 'Sale of Renewable Energy equipment'],
                ['value' => 'Shipping and Transport of Fossil Fuels'],
                // Add more subcategories as needed
            ],
            15 => [
                ['value' => 'Gambling - Activities of a Holding company'],
                ['value' => 'Gambling and betting activities'],
                ['value' => 'Gaming - client flow'],
                ['value' => 'Gaming - operational flow'],
                ['value' => 'Gaming Software Provider'],
                ['value' => 'Loot Boxes'],
                ['value' => 'Online Competitions, Raffles & Lotteries'],
                ['value' => 'Skilled Gaming'],
                // Add more subcategories as needed
            ],
            16 => [
                ['value' => 'Central government office'],
                ['value' => 'Foreign Embassies, Missions, or Consulates'],
                ['value' => 'Local government including councils'],
                ['value' => 'Parish councils'],
                ['value' => 'Public administration activities'],
                ['value' => 'Quasi non-governmental organisation (QUANGO)'],
                // Add more subcategories as needed
            ],
            17 => [
                ['value' => 'Dentist'],
                ['value' => 'Doctor / Nurse'],
                ['value' => 'Hospital activities'],
                ['value' => 'Opticians'],
                ['value' => 'Physiotherapy & Chiropractors'],
                ['value' => 'Residential care'],
                ['value' => 'Social work'],
                ['value' => 'Technical medical services'],
                // Add more subcategories as needed
            ],
            18 => [
                ['value' => 'Camping'],
        ['value' => 'Food and drink trucks'],
        ['value' => 'Hotels, hostels and bed & breakfast establishments'],
        ['value' => 'Pubs, bars and nightclubs'],
        ['value' => 'Restaurants and catering'],
                // Add more subcategories as needed
            ],
            19 => [
                ['value' => 'Computer programming, consultancy and related activities'],
                ['value' => 'Consultancy'],
                ['value' => 'Data sales'],
                ['value' => 'Non-Crypto Blockchain technology'],
                ['value' => 'SEO, SCO, Digital Marketing & Affiliate marketing'],
                ['value' => 'Software design and maintenance'],
                ['value' => 'Telecommunications'],
                ['value' => 'Website design and consultancy'],
                // Add more subcategories as needed
            ],
            20 => [
                ['value' => 'Freight, haulage & distribution'],
                ['value' => 'Maritime shipping and transportation'],
                ['value' => 'Postal and courier activities'],
                ['value' => 'Removal services'],
                ['value' => 'Warehousing and storage'],
                // Add more subcategories as needed
            ],
            21 => [
                ['value' => 'Building Materials and construction supplies'],
                ['value' => 'Manufacture of chemicals and Gases'],
                ['value' => 'Manufacture of computer, electronic and optical products'],
                ['value' => 'Manufacture of food and drink products'],
                ['value' => 'Manufacture of Medical Equipment and Supplies'],
                ['value' => 'Manufacture of personal and household goods'],
                ['value' => 'Manufacture of textiles, leather and clothing'],
                ['value' => 'Packaging & Storage Items'],
                ['value' => 'Repair and installation of machinery and equipment'],
                ['value' => 'Repair of computers, personal and household goods'],
                // Add more subcategories as needed
            ],
            22 => [
                ['value' => 'Building/Repair of marine vessels & watercraft'],
                ['value' => 'Financing of marine vessels & watercraft'],
                ['value' => 'Hire or charter of marine vessels & watercraft'],
                ['value' => 'Luxury Yachts'],
                ['value' => 'Military watercraft'],
                ['value' => 'Operational expenses of marine vessels & watercraft'],
                ['value' => 'Pleasure Vessels'],
                ['value' => 'Sale or purchase of marine vessel & watercraft'],
                // Add more subcategories as needed
            ],
            23 => [
                ['value' => 'Film and TV production'],
                ['value' => 'Media consultancy'],
                ['value' => 'Music, radio & podcasts'],
                ['value' => 'Non Adult - Online subscription services for digital goods'],
                ['value' => 'Publishing and print'],
                ['value' => 'Social media'],
                // Add more subcategories as needed
            ],
            24 => [
                ['value' => 'Aggregate and Mineral extraction excluding precious metals'],
                ['value' => 'Consultancy'],
                ['value' => 'Mineral extraction - Gemstones'],
                ['value' => 'Mineral extraction - Precious Metals including TTTG Metals'],
                ['value' => 'Mining of ores'],
                ['value' => 'Mining support activities including mineral exploration'],
                // Add more subcategories as needed
            ],
            25 => [
                ['value' => 'Crematorium (Human or Animal)'],
                ['value' => 'Driving instructor'],
                ['value' => 'Funeral directors'],
                ['value' => 'Hair, beauty and massage therapy'],
                ['value' => 'Interior Design'],
                ['value' => 'Tailor'],
                ['value' => 'Taxi & Chauffeur services'],
                // Add more subcategories as needed
            ],
            26 => [
                ['value' => 'Cannabis cultivation'],
                ['value' => 'Manufacture pharmaceutical products'],
                ['value' => 'Medical cannabis'],
                ['value' => 'Pharmaceutical testing & diagnostics'],
                ['value' => 'Supply of over the Counter Medication including Veterinary Medicines'],
                ['value' => 'Supply of Prescription Medication including Veterinary Medicines'],
                // Add more subcategories as needed
            ],
            27 => [
                ['value' => 'Aerospace engineering'],
        ['value' => 'All other engineering'],
        ['value' => 'Architects'],
        ['value' => 'Civil engineering'],
        ['value' => 'Corporate service provider'],
        ['value' => 'Legal Services'],
        ['value' => 'Scientific research and other activities'],
        ['value' => 'Veterinary activities'],
                // Add more subcategories as needed
            ],
            28 => [
                ['value' => 'Development and Investment in Real Estate'],
                ['value' => 'Estate Agencies'],
                ['value' => 'Land and building management'],
                ['value' => 'Property Rental Services'],
                ['value' => 'Property Surveyor'],
                // Add more subcategories as needed
            ],
            29 => [
                ['value' => 'Adult Toys and associated products'],
                ['value' => 'Alcoholic Beverages'],
                ['value' => 'Antiques, Art, Collectables & Second hand goods'],
                ['value' => 'Auction Houses & Online Marketplaces'],
                ['value' => 'Automotive Fuel'],
                ['value' => 'Chemicals and Industrial Solvents'],
                ['value' => 'Cosmetic products'],
                ['value' => 'Fireworks & Pyrotechnics'],
                ['value' => 'Food and drink products (excluding Alcoholic beverages)'],
                ['value' => 'Hardware including building materials'],
                ['value' => 'Household goods'],
                ['value' => 'Jewellery, Watches, Precious Metals & Gemstones'],
                ['value' => 'Lighting'],
                ['value' => 'Luxury Shoppers'],
                ['value' => 'Mail & Telephone Order Sales'],
                ['value' => 'Medical Equipment'],
                ['value' => 'Non-precious Metals'],
                ['value' => 'Other Miscellaneous Goods'],
                ['value' => 'Overseas General Trading Company - Non UAE/Hong Kong'],
                ['value' => 'Pawn Shops & Cash for Gold businesses'],
                ['value' => 'Portable electronic goods'],
                ['value' => 'Retail of Hydroponics equipment and gardening supplies'],
                ['value' => 'Sport and leisure equipment'],
                ['value' => 'Technical Equipment'],
                ['value' => 'Textiles and clothing products'],
                ['value' => 'Toys'],
                // Add more subcategories as needed
            ],
            30 => [
                ['value' => 'Cash and Carry stores'],
        ['value' => 'Convenience stores'],
        ['value' => 'Department Stores'],
        ['value' => 'Discount Stores'],
        ['value' => 'Specialty Stores'],
        ['value' => 'Supermarkets'],
        ['value' => 'Warehouse/Wholesale Stores'],
                // Add more subcategories as needed
            ],
            31 => [
                ['value' => 'Car Wash & Valet Services'],
                ['value' => 'Manufacture & Sale of Military Vehicles & Associated equipment'],
                ['value' => 'Manufacture, Sale, hire or charter of motor vehicles'],
                ['value' => 'Repair of motor vehicles'],
                ['value' => 'Repair of plant and heavy machinery'],
                ['value' => 'Sale of Vehicle parts and Accessories'],
                ['value' => 'Sale, hire or charter of plant and heavy machinery'],
                // Add more subcategories as needed
            ],
            32 => [
                ['value' => 'Recycling and waste management'],
        ['value' => 'Scrap metal dealers'],
        ['value' => 'Water collection, treatment and sewerage'],
                // Add more subcategories as needed
            ],
            33 => [
                ['value' => 'Creation and supply of Defense Software'],
                ['value' => 'Defense Consultancy and Training'],
                ['value' => 'Manufacture and supply of blades and offensive weapons'],
                ['value' => 'Manufacture and supply of defence equipment'],
                ['value' => 'Manufacture and supply of firearm and weaponry accessories'],
                ['value' => 'Manufacture and supply of firearms, ammunition, explosives and other weaponry (restricted under UK law)'],
                ['value' => 'Manufacture and supply of military and police grade anti riot equipment'],
                ['value' => 'Manufacture and supply of military and police uniform and associated equipment'],
                ['value' => 'Manufacture and supply of military vehicles and heavy equipment'],
                ['value' => 'Manufacture and supply of RIF and two-tone firearms'],
                ['value' => 'Military research'],
                ['value' => 'Purchase and supply of antique weaponry'],
                // Add more subcategories as needed
            ],
              // Repeat the process for other categories
              // Category 3, 4, 5, ..., etc.
          ];
  
          // Insert subcategory values for each category
          foreach ($subcategories as $categoryId => $values) {
              foreach ($values as $value) {
                  $value['category_id'] = $categoryId;
                  DB::table('sub_categories')->insert($value);
              }
          }
    }
}
