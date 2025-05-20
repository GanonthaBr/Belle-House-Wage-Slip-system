<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Decharge</title>
    {{-- Favicon --}}
    <link href="{{asset('public/images/logo.png')}}" rel="icon" />
    <link rel="stylesheet" href="{{asset('public/stylesheet.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body style="width: 100%;">
    <div class="receipt" style="margin: 1rem; width: 100%; margin-left:10rem">
        <div class="toolbar hidden-print">
            <div class="text-end">
                <a type="button" href="{{route('home')}}" class="btn btn-dark">
                    <i class="fa fa-print"></i> Retour
                </a>
                <a type="button" href="{{route('dechargepdf',$decharge->id)}}" class="btn btn-danger">
                    <i class="fa fa-file-pdf-o"></i> Exporter en PDF
                </a>
                <a type="button" href="{{route('editdecharge',$decharge->id)}}" class="btn btn-info">
                    <i class="fa fa-file-pdf-o"></i> Modifier
                </a>

            </div>
            <hr />
        </div>
       
                        <div class="row contacts">

                            <table>

                                <thead>

                                    <tr>

                                        <th style="width: 35%;"></th>

                                        <th style="width: 30%;"></th>

                                        <th style="width: 35%;"></th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>

                                            <div class="col invoice-to">



                                                <div class="text-gray-light">Délivré à:</div>



                                                <h3 class="to"> {{$decharge->gender}} {{$decharge->client_name}}</h3>



                                                <!-- <div class="address">

                                                    Adress



                                                </div> -->



                                                <div class="address">




                                                    Tel: {{$decharge->phone}}



                                                </div>


                                                <!-- 
                                                <div class="email">



                                                    Mail


                                                </div> -->



                                            </div>

                                        </td>

                                        <td>

                                            <div class="designation">
                                                <h2>DECHARGE</h2>
                                            </div>

                                        </td>

                                        <td>

                                            <div class="col invoice-details">
                                                <h1 class="invoice-id" style="font-size:12px">Numéro:
                                                    BH/Decharge/0{{intval($decharge->number)}}/{{date('Y',strtotime($decharge->created_at))}}/{{$decharge->created_at->format('m')}}

                                                </h1>
                                                <div class="date">Date: <b>{{$decharge->created_at->format('d/m/Y')}}</b> </div>
                                            </div>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="row subject">
                            <div class="col-12">
                                <p> <b style="text-decoration: underline;">Object:</b> {{$decharge->object}}</p>
                            </div>
                        </div>

                        <p style="color: #000;">


                            Je soussigné <strong>Mr. AGABA Moses,</strong> Directeur Général de Belle

                            House,atteste par la présente avoir reçu de <strong> {{$decharge->gender}} {{$decharge->client_name}}</> , la somme de <strong> {{$decharge->amout_received}} FCFA</strong>.</p>
                        <p>Ce montant correspond au paiement intégral pour <strong> {{$decharge->motif}} </strong> .</p>

                        <p>Je reconnais avoir reçu cette somme en toute satisfaction et déclare qu’aucune obligation financière ou autre liée à ce paiement ne saurait être imputée à <strong>{{$decharge->gender}} {{$decharge->client_name}} </strong> relative à ce service. </p>



                        <div class="thanks">Merci!</div>



                        <div class="notices">



                            <div class="title">NOTE Importante!</div>



                            <div class="notice">



                                <b> Fait pour servir et valoir ce que de droit! </b> <br>





                            </div>



                        </div>







                        <table height="200">
                            <thead>
                                <tr style="margin-bottom:-2rem">
                                    <th width="75%"></th>
                                    <th width="25%" style="margin-left: 1rem;padding-left:3.8rem" ;> <u>Signature:</u> </th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        @if($decharge->stamp=='1')

                                        <img src="{{$stamp}}" alt="stamp" width="150" height="180" style="transform: rotate(-20deg);margin-right:5rem;margin-top:-3rem">
                                        @endif
                                    </td>
                                </tr>
                            </thead>
                        </table>


    </div>
</body>

</html>