<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AmazonData;
use App\DownloadCsv;
use Illuminate\Support\Facades\Session;
use Auth;
use Redirect;

class IsbnController extends Controller
{

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function insertIsbn(Request $request){
     $data1=$request;
     
     if($request->select_type1 =="Isbn") { 
        $data = $request->search;
          // $isbn10=$data['search'];
           // print_r($data['search']);
        $data = str_replace("-","",$data);

        $isbn10=self::ISBN13toISBN10($data);
         // echo $isbn10;

        $amazon_data =AmazonData::where('isbn_10',$isbn10)->get();//take all data from data abase using all ()
       //print_r($AmazonData);
        if (!empty($amazon_data[0]->isbn_10)){
            return view('list', compact('amazon_data'));
        }else{
         $python_script="python book_fetched.py $isbn10" ;
         $output = exec($python_script); 
                       //echo $output;
         $amazon_data =AmazonData::where('isbn_10',$isbn10)->get();
            
            if (!empty($amazon_data->isbn_10)) {
               return view('list', compact('amazon_data'));
            }
               else{
                return redirect('/')->with('msg','Record not found');
               } 


                            // if (empty($amazon_data[0]->isbn_10)){
                            //     return view('index', compact('message'));
                            // }

     }
                //     return view('index', compact('message'));
                // }
        // return view('list');

 }else {   


    return  self::getTitle($data1);

}
}

public function getTitle($data)
{
    $search_title=$data->search;
    $amazon_data =AmazonData::where('title','LIKE','%'.$search_title.'%')->get();
        //echo $data->search;
       // echo "in get method";
       // print_r($amazon_data);
    if(!empty($amazon_data->title))
    {
    return view('list', compact('amazon_data'));
    }else{
        return redirect('/')->with('msg','Record not found');

    }

    // print_r($request);
        //return Redirect::to('index');
}
//where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();

public function addtolist(Request $request)
        {
            $data = $request;
            if(\Auth::check()){
                    $user_status = Auth::user()->status;
            }else{ $user_status=0;}
           // print_r($data);
            if(!empty($data->addtolist)){    
                        //echo $data;
                        //echo $request->isbn_10;
                        //echo "ADD to list";
                    foreach ($data->addtolist as $key => $value) {
                          //Session::set('session_isbn', $value);
                           // session()->set('session_isbn', $value);
                        Session::push('session_isbn',$value);
                            //echo $value;

                    }
                    $session_isbn=Session::get('session_isbn');

                        //$session_isbn=$session_isbn->unique();
                    $session_isbn=array_unique($session_isbn);
                    foreach ($session_isbn as $key => $value) {
                      $amazon_data[]=AmazonData::where('isbn_10',$value)->first();
                  }

                       //print_r($session_isbn);
                  return view('addtolist', compact('amazon_data','user_status'));
                }else {return redirect()->back()->with('msg', 'Please select record for Add to List');}
        }

public function downloadcsv(Request $request)
{
     

     if(\Auth::check()){
        
       
       
               unset($_GET["addtolist"]);
             
               Session::forget('session_isbn') ;

                $data=$request->addtolist;
                if(!empty($data))
                {
                foreach ($data as $key => $value) {
                $amazon_data[]=AmazonData::where('isbn_10',$value)->first();
                     }
            
                    foreach ($amazon_data as $key => $az_data) {
              
                    $amazon_data1[]=array(
                    "isbn_10"=>$az_data->isbn_10,
                    "isbn_13"=> $az_data->isbn_13,
                    "title"=> $az_data->title,
                    "author"=> $az_data->author,
                    "publisher"=> $az_data->publisher,
                    "language"=> $az_data->language,
                    "Subjectdb"=> $az_data->Subjectdb
                    ); 
                    }
                    $file_name='isbn'.date('m-d-Y-hia').'.csv';

                    $u_id = Auth::user()->id; //for insert into downloadcsv
                    $download_csv = new DownloadCsv([
                    'csv_name' => $file_name,
                    'u_id'=>$u_id
                    ]);
                    $download_csv->save();

                    self::outputCsv($file_name,$amazon_data1);
                } //2nd if close
                else {return redirect()->back()->with('msg', 'Please select record for Download Csv');}

} 
else{
        return redirect('/login');
    }
}



public function outputCsv($fileName, $assocDataArray)
{
    
        
    for ($i=0; $i < count($assocDataArray); $i++) { 
        

        $exploaded_subject=explode(",",$assocDataArray[$i]["Subjectdb"]);
        $exploaded_author=explode(",",$assocDataArray[$i]["author"]);

                $counter=0;
                foreach ($exploaded_subject as $key => $value) {
                //echo $value;
                $assocDataArray[$i]["Subject".$counter]=$value;
                $counter ++;
                }
        $array_count[]=count($assocDataArray[$i]);

    }

    $b= array_keys($array_count,max($array_count));
 
    print_r($b[0]);
    
    ob_clean();

    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $fileName);    
    if(isset($assocDataArray[0])){
        $fp = fopen('php://output', 'w');
        unset($assocDataArray[$b[0]]["Subjectdb"]);
       
        fputcsv($fp, array_keys($assocDataArray[$b[0]]));
        foreach($assocDataArray AS $values){
           unset($values["Subjectdb"]);
           
           
            fputcsv($fp, $values);
        }
        fclose($fp);
    }
    
    ob_flush();
  
}





public function ISBN13toISBN10($isbn) {
    if (preg_match('/^\d{3}(\d{9})\d$/', $isbn, $m)) {
        $sequence = $m[1];
        $sum = 0;
        $mul = 10;
        for ($i = 0; $i < 9; $i++) {
            $sum = $sum + ($mul * (int) $sequence{$i});
            $mul--;
        }
        $mod = 11 - ($sum%11);
        if ($mod == 10) {
            $mod = "X";
        }
        else if ($mod == 11) {
            $mod = 0;
        }
        $isbn = $sequence.$mod;
    }
    return $isbn;
}

public function create()
{
        //
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
