<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Decharge</title>

    {{-- Favicon --}}

    <link href="{{asset('images/logo.png')}}" rel="icon" />

    <link rel="stylesheet" href="{{asset('stylesheet.css')}}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    {{-- <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" /> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    {{-- <link href="https://fonts.googleapis.com/css2?family=Playwrite+CL:wght@100..400&display=swap" rel="stylesheet" /> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet" />



</head>

<style>
    body {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: normal;
        /* background-color: #f8f8f8; */
        display: flex;
        height: 100vh;
        margin: 0;
    }



    .receipt-details {

        /* background: #ffffff; */

        padding: 20px;

        /* border: 1px dashed #61a1d6; */

        width: 100%;

        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }

    .header {
        width: 100%;
        height: 200px;
        flex-direction: row;
    }

    .receipt .company-details .name {



        margin-top: 0;



        margin-bottom: 0;



    }

    .receipt .company-details .name a {



        color: #61a1d6;

        font-size: 27px;



    }

    .company p {
        font-size: 12px;

    }

    .company-details span {



        font-size: 14px;



    }

    .header-div {



        min-width: 600px;



    }

    .roboto-light-italic {

        font-family: "Roboto", sans-serif;

        font-weight: 300;

        font-style: italic;

        color: #61a1d6;

    }

    .receipt .header {
        padding: 10px 0;
        margin-bottom: 5px;
        border-bottom: 1px solidrgb(155, 196, 231);
    }

    .receipt-details {

        display: flex;

        flex-direction: row;

        justify-content: space-between;

        margin: 40px 0;

        font-size: 14px;

    }

    .body {

        /* font-family: "Playwrite PE", cursive; */

        font-optical-sizing: auto;

        font-weight: 400;

        font-style: normal;

    }

    .body strong {

        font-weight: bold;

    }

    .footer {

        margin-top: 10px;

        padding: 0;

    }

    .footer .contact {

        margin: 10px 0;

        height: 50px;

        font-size: 14px;

        display: flex;

        flex-direction: column;

        /* justify-content: flex-start; */

        align-items: flex-start;

    }

    .bottom {
        margin-top: 40px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
</style>



<body>

    <div class="receipt">



        <div class="header">
            {{-- <table>

                <tr>

                    <th style="width: 60%;"></th>



                    <th style="width: 40%;"></th>>

                </tr>

                <tr>

                    <td>

                        <div class="logo" style="margin-left:10px">

                            <img src="{{$image}}" alt="Belle House Logo" width="140" height="120" />

        </div>

        </td>

        <td>

            <div class="company-details">

                <h1>BELLE HOUSE CONSTRUCTION MODERNE</h1>

                <p>

                    Architecture-Ingénierie-Design- Maçonnerie- Consulting

                    BTP - Ferraillage Coffrage-Electricité-Plomberie

                </p>

                <p>

                    Staff- Carrelage-Vitrage- Soudure- Menuiserie-

                    Photographie Bâtiment- Aménagement- Jardinage

                </p>

                <p>

                    Email: <a href="mailto@contact@bellehouseniger.com ">contact@bellehouseniger.com </a>| Site:

                    <a href=" www.bellehouseniger.com"> www.bellehouseniger.com</a>

                </p>

                <p class="rccm-nif">RCCM-NI-NIA-2017-A-2845 NIF: 43391/P</p>

            </div>

        </td>

        </tr>

        </table> --}}
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 70%;"></th>
                    <th style="width: 30%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="#"> <b>BELLE HOUSE</b> </a>
                            </h2>
                            <b style="font-size: 8px;"> ENTREPRISE DE CONSTRUCTION MODERNE </b>
                            <div>Adresse : <span style="color:#61a1d6">Bobiel Niamey-Niger</span> </div>
                            <div>Numéro de téléphone : <span style="color:#61a1d6">+227 92 08 50 50</span> </div>
                            <div class="email">Email:
                                <a href="mailto:contact@bellehouseniger.com"><span class="__cf_email__" data-cfemail="cca6a3a4a28ca9b4ada1bca0a9e2afa3a1" style="color:#61a1d6">Contact@bellehouseniger.com</span></a>
                            </div>
                            <div class="email">Site Web:
                                <a href="www.bellehouseniger.com"><span class="__cf_email__"> <span style="color:#61a1d6">bellehouseniger.com</span> </span></a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="col">

                            <!--src="{{ public_path('assets/fotoKue/kue-fazril.jpg') }}"-->
                            <img src="{{$image}}" width="180" height="140" alt="logo" style="margin-left: 3rem;" />

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



    <br>

    <div class="receipt-details">

        <table>

            <thead>

                <tr>

                    <th style="width: 80%;"></th>

                    <th style="width: 20%;"></th>>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>



                        <div class="number">

                            <p>Decharge N<sup>o</sup> {{$decharge->number}} </p>

                        </div>

                    </td>



                    <td>



                        <div class="date" style="margin-left: 25rem;">

                            <p>Niamey le <b>{{$decharge->created_at->format('d/m/Y')}}</b></p>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <hr style="border: #61a1d653 1px solid">

    <div class="body roboto-light-italic">

        <p style="color: #000;">

            Je soussigné <strong>Mr AGABA Moussa,</strong> Directeur Général de Belle

            House,Atteste avoir reçu de la part de Mr/Mme <strong> {{$decharge->client_name}} </strong> la somme de

            <strong> {{$decharge->amout_received}} FCFA</strong> pour

            <strong> {{$decharge->motif}} </strong>.

        </p>
        <p style="color: #000;">
            Je reconnais avoir reçu cette somme en toute satisfaction et décharge <strong> {{$decharge->client_name}} </strong> de toute obligation relative à ce paiement.
        </p>

    </div>

    <div class="bottom">

        <table style="width: 100%;">

            <tr>

                <th style="width: 60%;"></th>

                <th style="width: 40%;"></th>>

            </tr>

            <tr>

                <td>

                    <div class="footer" style="text-align: start;">

                        <div class="roboto-light-italic signature" style="margin-right: 0;text-align:start">

                            <p class="">Fait pour servir et valoir ce que de droit</p>

                        </div>

                        <div class="contact" style="text-align: start;margin-right:20px">

                            <p> <b>+227 92 08 50 50 </b> / <b> +227 99 08 50 50</b> </p>



                        </div>



                    </div>

                </td>

                <td>

                    <div class="stamp">

                        <i> <u>Signature:</u> </i>

                    </div>

                </td>

            </tr>

        </table>







    </div>

    </div>

</body>



</html>