<?php

namespace App\Http\Controllers;

use App\Jas;
use App\Models\Ref_obj;
use App\Models\Reports\Form51;
use App\Models\Reports\Form52;
use App\Models\Reports\Form52_table;
use App\Models\Reports\Form5363;
use App\Models\Reports\Form5363_table;
use App\Models\Reports\Form61;
use App\Models\Reports\Form62;
use App\Models\Rtn\Action_plan_pb;
use App\Models\Rtn\Data_check;
use App\Models\Rtn\Info_GDA;
use App\Models\Rtn\Pmla;
use App\Models\Rtn\Report_tu;
use App\Models\Rtn2\Act_reason_accident;
use App\Models\Rtn2\General_info;
use App\Models\Rtn2\Info_accident_investigation;
use App\Models\Rtn2\Info_building;
use App\Models\Rtn2\Info_insurance;
use App\Models\Rtn2\Info_manage_system;
use App\Models\Rtn2\Info_pk;
use App\Models\Rtn2\Info_plan;
use App\Models\Rtn2\Info_respons_worker;
use App\Models\Rtn2\Info_tu;
use App\Models\Rtn2\Kol_vo_checking;
use App\Models\Rtn2\Mark_ready;
use App\Models\Rtn2\Name_work;
use App\Models\Rtn2\Offers;
use App\Models\Rtn2\Organisation;
use App\Models\Rtn2\Plan_event;
use App\Models\Rtn2\Planing;
use App\Models\Rtn2\Realization;
use App\Models\Rtn2\Signed_data;
use App\Models\Rtn2\Status_tu;
use App\Models\Status_work;
use App\Models\Xml\Ssr_reports;
use App\Models\Xml\Svr_factors;
use App\Models\Xml\Svr_reports;
use App\Models\XML_journal;
use App\Ref_opo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use XmlResponse\Facades\XmlFacade;
use Spatie\ArrayToXml\ArrayToXml;


class XMLController extends Controller
{

    public function automatic_event()
    {
        $now = date('Y-m-d H:i:s');
        $data = date('Y-m-d H:i:s', strtotime($now.'- 1 minutes'));

        $jas_data = Jas::orderByDesc('id')->where('level', '!=', 'C4')->where('level', '!=', 'АПК')->get();
        if (count($jas_data)){
            foreach ($jas_data as $row){
                //для отправки xml
                $contents = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sdk=\"sdkrtn\">\n";
                $contents = $contents . "   <soapenv:Header/>\n";
                $contents = $contents . "       <soapenv:Body>\n";
                $contents = $contents . "           <sdk:AutomaticEvent>\n";
                if ($row->level == 'С3'){
                    $class = 3;
                } elseif ($row->level == 'С2'){
                    $class = 2;
                } elseif ($row->level == 'С1'){
                    $class = 1;
                }

                $obj_data = Ref_obj::where('idObj', '=', $row->from_elem_opo)->first();
                $guid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
                $numOPO = Ref_opo::where('idOPO', '=', $obj_data->idOPO)->select('regNumOPO')->first();
                $contents = $contents . "               <sdk:automaticEvent EventClass=\"".$class."\" EventDescription=\"". $row->name."\" EventDateTime=\"".date('Y-m-d').'T'.date('H:i:s').'+04:00'."\" EventStatus=\""."4"."\" HazardousObjectNumber=\"".$numOPO['regNumOPO']."\" RequestGuid=\"".$guid."\" Ogrn=\"1023001538460\" ID=\"1\">\n";
                $contents = $contents . "                   <sdk:ProductionSites>\n";
                $contents = $contents . "                       <sdk:EntityReferenceWithName Name=\"".$obj_data->nameObj."\" Guid=\"".$obj_data->guid."\" />\n";
                $contents = $contents . "                   </sdk:ProductionSites>\n";
                $contents = $contents . "               </sdk:automaticEvent>\n";
                $contents = $contents . "           </sdk:AutomaticEvent>\n";
                $contents = $contents . "       </soapenv:Body>\n";
                $contents = $contents . "</soapenv:Envelope>\n";
                Storage::disk('remote-sftp')->put('automatic_event.xml', $contents, 'public'); // Для передачи по SFTP

            }
        } else{
            return true;
        }
    }


}
