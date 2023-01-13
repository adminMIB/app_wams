<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\Bast;
use App\Models\ListProjectAdmin;
use App\Models\ProgressStatus;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\User;
use App\Models\Wodlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UmDashboardController extends Controller
{
    public function index(Request $request)
    {
        $Smenang = SalesOpty::where('Status', 'PO/Contract')->count();
        $Amenang = ListProjectAdmin::where('Status', 'PO/Contract')->count();
        $totalmenang = $Smenang + $Amenang;

        $dataBast = Bast::with('so')->get();
        $dataBastOven = [];
        $dataBastComplete = [];
        $dataBastHold = [];

        foreach ($dataBast as $key => $value) {
            switch ($value->status) {
                case 'Open':
                    $dataBastOven[] = $value;
                break;
                case 'Completed':
                    $dataBastComplete[] = $value;
                break;
                case 'Hold':
                    $dataBastHold[] = $value;
                break;
                default:
                    break;
            }
        }

            $projectSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->get();
            $projectAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userTechnikal', 'ltoproject.bast')->get();
    
            $dataProjectMenang = [];
            $dataProjectKalah = [];
            $dataProjectDataOven = [];
            $dataProjects = [];

            if ($request->dari_tgl || $request->sampai_tgl) {
                $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
                $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
                $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($data as $key => $value) {
                    $dataProjectMenang[] =  $value;
                }
            } else {
                foreach ($projectSales as $key => $value) {
                    $dataProjects [] = $value;
                    switch ($value->Status) {
                        case 'PO/Contract':
                                $dataProjectMenang [] = $value;                            
                            break;
                        case 'Lost':
                                $dataProjectKalah [] = $value;         
                                // return $dataProjectKalah;                          
                            break;
                        default:
                            break;
                    }
                }
            }

            if ($request->dari_tgl || $request->sampai_tgl) {
                $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
                $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
                $data = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($data as $key => $value) {
                    $dataProjectMenang[] =  $value;
                }
            } else {
                foreach ($projectAdmin as $key => $value) {
                    $dataProjects [] = $value;
                    switch ($value->Status) {
                        case 'PO/Contract':
                                $dataProjectMenang [] = $value;                            
                            break;
                        case 'Lost':
                                $dataProjectKalah [] = $value;  
                                // return $dataProjectKalah;                          
                            break;    
                        default:                            
                            break;
                    }

                }
            }

            $nama = [];
            $jumlahNama = [];

            // ! By Contract -> chart pie 
            $dataSO = SalesOrder::with('listadmin', 'listpipe')->select('id', 'name_user', 'contract_amount', 'status_project')->get()->groupBy(function($dataSO) {
                return $dataSO->name_user;
            });;

            foreach ($dataSO as $key => $value) {
                $namas[] = $key;
                $nama =  array_unique($namas);
                $jumlahNama[] = count($value);
            }

            // ! Contribution by Projects
            $namaByProjects = [];
            $jumlahNamaByProjects = [];

            $dataContarctSalesA = SalesOpty::with('userTechnikalsPipe.userTechnikal')->select('id', 'name_user')->get()->groupBy(function($dataContarctSalesA) {
                return $dataContarctSalesA->name_user;
            });

            foreach ($dataContarctSalesA as $key => $value) {
                $namaByProjects[] = $key;
                // $nama =  array_unique($namas);
                $jumlahNamaByProjects[] = count($value);
            }

            $dataContarctAdminA = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userTechnikal', 'ltoproject.bast')->select('id','name_user')->get()->groupBy(function($dataContarctAdminA) {
                return $dataContarctAdminA->name_user;
            });

            foreach ($dataContarctAdminA as $key => $value) {
                $namaByProjects[] = $key;
                $jumlahNamaByProjects[] = count($value);
            }

            $dataWodlist = Wodlist::with('sorder.userTechnikals.AM', 'sopty')->get();
            // return $dataWodlist;
            
            // return $jumlahNama;
            $pipebyname = SalesOpty::select('id', 'name_user')->get()->groupBy(function($pipebyname) {
                return $pipebyname->name_user;
            });

            $namacontract = [];
            
            foreach ($pipebyname as $key => $value) {
                $namacontract[] = $key;
            }
            // contract
            $pipebycontract = SalesOpty::select('id', 'name_user', 'contract_amount')->where('Status', 'PO/Contract')->get()->groupBy(function($pipebycontract) {
                return $pipebycontract->name_user;
            });

            $jumlahContract = [];
            
            foreach ($pipebycontract as $key => $value) {
                $totjumlahContract = 0;
                foreach ($value as $val) {
                    $totjumlahContract += $val->contract_amount;
                }
                $jumlahContract[] = $totjumlahContract;
            }
            // return $namacontract;
            // lost
            $pipebylost = SalesOpty::select('id', 'name_user', 'contract_amount')->where('Status', 'Lost')->get()->groupBy(function($pipebylost) {
                return $pipebylost->name_user;
            });

            $jumlahlost = [];
            
            foreach ($pipebylost as $key => $value) {
                $totjumlahContract = 0;
                foreach ($value as $val) {
                    $totjumlahContract += $val->contract_amount;
                }
                $jumlahlost[] = $totjumlahContract;
            }
            // return $jumlahlost;

            // estimated
            $pipebyesti = SalesOpty::select('id', 'name_user', 'estimated_amount')->get()->groupBy(function($pipebyesti) {
                return $pipebyesti->name_user;
            });

            $jumlahesti = [];
            
            foreach ($pipebyesti as $key => $value) {
                $totjumlahesti = 0;
                foreach ($value as $val) {
                    $totjumlahesti += $val->estimated_amount;
                }
                $jumlahesti[] = $totjumlahesti;
            }
            // return $jumlahesti;

            $totalpipecont = SalesOpty::where('Status', 'PO/Contract')->sum('contract_amount');
            $totalpipelost = SalesOpty::where('Status', 'Lost')->sum('contract_amount');
            $totalpipeesti = SalesOpty::sum('estimated_amount');
            // return $totalpipeesti;

        return view('UM.dashboard', 
            compact('totalmenang','totalpipecont','totalpipelost','totalpipeesti','namacontract','jumlahContract','jumlahlost','jumlahesti', 'dataProjectKalah', 'dataBast', 'dataProjectMenang', 'dataProjects', 'nama', 'jumlahNama', 'namaByProjects', 'jumlahNamaByProjects', 'dataBastOven', 'dataBastComplete', 'dataBastHold'));
    }

    public function projects(Request $request)
    { 
        $prostat = ProgressStatus::all();
        $namaAm = Role::with('users')->where('name', 'AM/Sales')->get();
        $namaTechnikal = Role::with('users')->where('name', 'Technikal')->get();
        
        $dataProjects = [];
        
        if ($request->dari_tgl && $request->sampai_tgl && $request->name && $request->Status && $request->nameTechnikal) {
            // dd($request->nameTechnikal);
            //! projects sales
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('name_user', $request->name)->where('Status', $request->Status)->get();

            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null ) {
                        
                    } else {
                        if ($item->userTechnikal->name == $request->nameTechnikal && $value->name_user == $request->name) {
                                $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }
            
            // //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', $request->Status)->get();
            foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null || $item->userTechnikal === null) {
                        } else {
                            if ( $item->userTechnikal->name == $request->nameTechnikal && $item->AM->name == $request->name) {
                                $dataProjects[] = $value;
                            } 
                        }
                    }
                }

            // return $dataProjects;

        } else if($request->dari_tgl && $request->sampai_tgl && $request->name && $request->nameTechnikal)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('name_user', $request->name)->get();
            
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null && $item->userTechnikal === null) {
                            
                        } else {
                            if ($item->AM->name == $request->name && $item->userTechnikal->name == $request->nameTechnikal) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else if($request->dari_tgl && $request->sampai_tgl && $request->nameTechnikal)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
            
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->userTechnikal === null) {
                            
                        } else {
                            if ($item->userTechnikal->name == $request->nameTechnikal) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        }  else if($request->dari_tgl && $request->sampai_tgl && $request->name)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('name_user', $request->name)->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null) {
                            
                        } else {
                            if ($item->AM->name == $request->name) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        }else if($request->dari_tgl && $request->sampai_tgl && $request->Status)
        {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', $request->Status)->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }
            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', $request->Status)->get();
                foreach ($dataAdmin as $key => $value) {
                    $dataProjects[] = $value;
                }
        } else if($request->dari_tgl && $request->sampai_tgl)
        {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }
            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->get();
                foreach ($dataAdmin as $key => $value) {
                    $dataProjects[] = $value;
                }
        } else if($request->name && $request->status)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('name_user', $request->name)->where('Status', $request->name)->get();
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->where('Status', $request->Status)->get();
            // return $dataAdmin;
            foreach ($dataAdmin as $key => $value) {
                foreach ($value->userTechnikals as $key => $item) {
                    if ($item->AM === null) {
                            
                    } else {
                        if ($item->AM->name == $request->name) {
                            $dataProjects[] = $value;
                        } 
                    }
                }
            }
            // return $data;
        } else if($request->name)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('name_user', $request->name)->get();
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->get();
            // return $dataAdmin;
            foreach ($dataAdmin as $key => $value) {
                foreach ($value->userTechnikals as $key => $item) {
                    if ($item->AM === null) {
                            
                    } else {
                        if ($item->AM->name == $request->name) {
                            $dataProjects[] = $value;
                        } 
                    }
                }
            }
            // return $data;
        } else if($request->Status)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('Status', $request->Status)->get();
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }
            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->get();
                foreach ($dataAdmin as $key => $value) {
                    // foreach ($value->userTechnikals as $key => $item) {
                        if ($value->Status == $request->Status) {
                            $dataProjects[] = $value;
                        } 
                    // }
                }

        } else if($request->nameTechnikal)
        {

            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->get();
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->userTechnikal === null) {
                            
                        } else {
                            if ($request->nameTechnikal == $item->userTechnikal->name ) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else {
            $projectAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userPresale', 'userTechnikals.userTechnikal', 'ltoproject.bast')->get();
            $projectSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->get();
            
            foreach ($projectAdmin as $key => $value) {
                $dataProjects [] = $value;
            }

            foreach ($projectSales as $key => $value) {
                $dataProjects [] = $value;
            }
                        
        }
        
        return view('UM.dashboard.projects', compact('dataProjects', 'prostat', 'namaAm', 'namaTechnikal'));
    }

    public function projectMenang(Request $request)
    { 
        $prostat = ProgressStatus::all();
        $namaAm = Role::with('users')->where('name', 'AM/Sales')->get();
        $namaTechnikal = Role::with('users')->where('name', 'Technikal')->get();
        
        $dataProjects = [];
        
        if ($request->dari_tgl && $request->sampai_tgl && $request->name && $request->nameTechnikal) {
            // dd($request->nameTechnikal);
            //! projects sales
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('name_user', $request->name)->where('Status', 'PO/Contract')->get();

            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null ) {
                        
                    } else {
                        if ($item->userTechnikal->name == $request->nameTechnikal && $value->name_user == $request->name) {
                                $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }
            
            // //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
            foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null || $item->userTechnikal === null) {
                        } else {
                            if ( $item->userTechnikal->name == $request->nameTechnikal && $item->AM->name == $request->name) {
                                $dataProjects[] = $value;
                            } 
                        }
                    }
                }

            // return $dataProjects;

        } else if($request->dari_tgl && $request->sampai_tgl && $request->name && $request->nameTechnikal)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->where('name_user', $request->name)->get();
            
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null && $item->userTechnikal === null) {
                            
                        } else {
                            if ($item->AM->name == $request->name && $item->userTechnikal->name == $request->nameTechnikal) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else if($request->dari_tgl && $request->sampai_tgl && $request->nameTechnikal)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
            
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->userTechnikal === null) {
                            
                        } else {
                            if ($item->userTechnikal->name == $request->nameTechnikal) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        }  else if($request->dari_tgl && $request->sampai_tgl && $request->name)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->where('name_user', $request->name)->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null) {
                            
                        } else {
                            if ($item->AM->name == $request->name) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else if($request->dari_tgl && $request->sampai_tgl)
        {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }
            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'PO/Contract')->get();
                foreach ($dataAdmin as $key => $value) {
                    $dataProjects[] = $value;
                }
        }  else if($request->name)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('name_user', $request->name)->where('Status', 'PO/Contract')->get();
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->where('Status', 'PO/Contract')->get();
            // return $dataAdmin;
            foreach ($dataAdmin as $key => $value) {
                foreach ($value->userTechnikals as $key => $item) {
                    if ($item->AM === null) {
                            
                    } else {
                        if ($item->AM->name == $request->name) {
                            $dataProjects[] = $value;
                        } 
                    }
                }
            }
            // return $data;
        } else if($request->nameTechnikal)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('Status', 'PO/Contract')->get();
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->where('Status', 'PO/Contract')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->userTechnikal === null) {
                            
                        } else {
                            if ($request->nameTechnikal == $item->userTechnikal->name ) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else {
            $projectAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userPresale', 'userTechnikals.userTechnikal', 'ltoproject.bast')->where('Status', 'PO/Contract')->get();
            $projectSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('Status', 'PO/Contract')->get();
            
            foreach ($projectAdmin as $key => $value) {
                $dataProjects [] = $value;
            }

            foreach ($projectSales as $key => $value) {
                $dataProjects [] = $value;
            }
            
            // return $projectSales;
            
        }
        
        return view('UM.dashboard.projectMenang', compact('dataProjects', 'prostat', 'namaAm', 'namaTechnikal'));
    }

    public function projectKalah(Request $request)
    { 
        $prostat = ProgressStatus::all();
        $namaAm = Role::with('users')->where('name', 'AM/Sales')->get();
        $namaTechnikal = Role::with('users')->where('name', 'Technikal')->get();
        
        $dataProjects = [];
        
        if ($request->dari_tgl && $request->sampai_tgl && $request->name && $request->nameTechnikal) {
            // dd($request->nameTechnikal);
            //! projects sales
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('name_user', $request->name)->where('Status', 'Lost')->get();

            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null ) {
                        
                    } else {
                        if ($item->userTechnikal->name == $request->nameTechnikal && $value->name_user == $request->name) {
                                $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }
            
            // //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
            foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null || $item->userTechnikal === null) {
                        } else {
                            if ( $item->userTechnikal->name == $request->nameTechnikal && $item->AM->name == $request->name) {
                                $dataProjects[] = $value;
                            } 
                        }
                    }
                }

            // return $dataProjects;

        } else if($request->dari_tgl && $request->sampai_tgl && $request->name && $request->nameTechnikal)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->where('name_user', $request->name)->get();
            
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null && $item->userTechnikal === null) {
                            
                        } else {
                            if ($item->AM->name == $request->name && $item->userTechnikal->name == $request->nameTechnikal) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else if($request->dari_tgl && $request->sampai_tgl && $request->nameTechnikal)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
            
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->userTechnikal === null) {
                            
                        } else {
                            if ($item->userTechnikal->name == $request->nameTechnikal) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        }  else if($request->dari_tgl && $request->sampai_tgl && $request->name)
        {
            
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->where('name_user', $request->name)->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->AM === null) {
                            
                        } else {
                            if ($item->AM->name == $request->name) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else if($request->dari_tgl && $request->sampai_tgl)
        {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
            
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }
            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'Lost')->get();
                foreach ($dataAdmin as $key => $value) {
                    $dataProjects[] = $value;
                }
        }  else if($request->name)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('name_user', $request->name)->where('Status', 'Lost')->get();
            foreach ($data as $key => $value) {
                $dataProjects[] =  $value;
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->where('Status', 'Lost')->get();
            // return $dataAdmin;
            foreach ($dataAdmin as $key => $value) {
                foreach ($value->userTechnikals as $key => $item) {
                    if ($item->AM === null) {
                            
                    } else {
                        if ($item->AM->name == $request->name) {
                            $dataProjects[] = $value;
                        } 
                    }
                }
            }
            // return $data;
        } else if($request->nameTechnikal)
        {
            $data = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('Status', 'Lost')->get();
            foreach ($data as $key => $value) {
                foreach ($value->userTechnikalsPipe as $key => $item) {
                    if ($item->userTechnikal === null) {
                        
                    } else {
                        if ($request->nameTechnikal == $item->userTechnikal->name ) {
                            $dataProjects[] = $value;
                        } 
                    }
                    
                }
            }

            //! project admin
            $dataAdmin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM')->where('Status', 'Lost')->get();
                foreach ($dataAdmin as $key => $value) {
                    foreach ($value->userTechnikals as $key => $item) {
                        if ($item->userTechnikal === null) {
                            
                        } else {
                            if ($request->nameTechnikal == $item->userTechnikal->name ) {
                                $dataProjects[] = $value;
                            } 
                        }
                        
                    }
                }

        } else {
            $projectAdmin = ListProjectAdmin::with('userTechnikals.AM', 'userTechnikals.userPresale', 'userTechnikals.userTechnikal', 'ltoproject.bast')->where('Status', 'Lost')->get();
            $projectSales = SalesOpty::with('userTechnikalsPipe.userTechnikal')->where('Status', 'Lost')->get();
            
            foreach ($projectAdmin as $key => $value) {
                $dataProjects [] = $value;
            }

            foreach ($projectSales as $key => $value) {
                $dataProjects [] = $value;
            }
            
            // return $projectSales;
            
        }
        
        return view('UM.dashboard.projectKalah', compact('dataProjects', 'prostat', 'namaAm', 'namaTechnikal'));
    }


    public function projectBastOven(Request $request)
    {
        $namaAm = Role::with('users')->where('name', 'AM/Sales')->get();
        $dataBast = Bast::with('so')->where('status', 'Open')->get();

        return view('UM.dashboard.projectBastOven', compact('dataBast', 'namaAm'));
    }

    public function projectBastHold(Request $request)
    {
        $dataBast = Bast::with('so')->where('status', 'Hold')->get();

        return view('UM.dashboard.projectBastHold', compact('dataBast'));
    }

    public function projectBastCompleted(Request $request)
    {
        $dataBast = Bast::with('so')->where('status', 'Completed')->get();

        return view('UM.dashboard.projectBastCompleted', compact('dataBast'));
    }


}

