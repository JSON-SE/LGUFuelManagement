@extends('layouts.Backend.admin.admin')
@section('content')
<section id="body-content" class="">
    <div class="container-fluid px-lg-5 px-md-4 pb-5 pt-lg-3">
        <div class="row pt-4">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='white'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item active">Welcome to Dashboard</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <div class="row pb-4">
        <div class="col-sm-6 text-white my-auto">
            <h3 class="mb-0">{{Auth::guard('admin')->user()->name}}</h3>
        </div>
        <div class="col-sm-6 pt-3 pt-lg-0 my-auto d-flex justify-content-sm-end">
            <button class="btn btn-light">New view</button>
            <button class="btn btn-primary d-flex align-items-center ms-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus" viewBox="0 0 16 16">
                <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            <span class="d-none d-md-block">Create new report</span>
        </button>
    </div>
</div>


<div class="row">
    <div class="col-lg-3 col-sm-6 pt-3">
        <div class="card overview-chart-box border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <p class="mb-0 mb-0">SALES</p>
                    </div>

                    <div class="col-6 text-end">
                        <div class="dropdown me-3">
                            <button class="btn btn-sm dropdown-toggle" type="button" id="last-date"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Last 7 Days
                        </button>
                        <ul class="dropdown-menu dropdown-menu-sm dropdown-custom dropdown-menu-end"
                        aria-labelledby="last-date">
                        <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                        <li><a class="dropdown-item" href="#">Last 10 Days</a></li>
                        <li><a class="dropdown-item" href="#">Last 20 Days</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="d-flex align-items-end pt-2">
            <h2 style="color: #fe3371;" class="card-title mb-0">75%</h2>
            <p
            class="text-success border ms-2 px-1 mb-2 d-inline-block update-arrow-box rounded fe3371">
            7%
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
            </svg>
        </span>
    </p>
</div>

<div class="graph__wrapper">

    <div>

        <svg width="100%" height="25%" viewBox="0 0 300 75" stroke="#fe3371"
        stroke-linecap="round" stroke-width="2">
        <path id="react-trend-3987689759369169" d="M 8,67
        L 51.23589776737681,46.58612381341844
        S 64.8,40.18181818181819 79.39871014121,43.628216622644814
        L 107.00128985878999,50.144510650082466
        S 121.6,53.59090909090909 133.29785610309847,44.20154475719609
        L 166.70214389690153,17.389364333713
        S 178.4,8 189.72360765152317,17.837474765119673
        L 223.87639234847683,47.50797978033487
        S 235.2,57.345454545454544 249.36055863977725,52.397871397145686
        L 292,37.5" fill="none" class="path">
    </path>
</svg>

</div>
</div>


</div>
</div>
</div>

<div class="col-lg-3 col-sm-6 pt-3">
    <div class="card overview-chart-box border-0 shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6">
                    <p class="mb-0">REVENUE
                    </p>
                </div>

                <div class="col-6 text-end">
                    <div class="dropdown me-3">
                        <button class="btn btn-sm dropdown-toggle" type="button" id="last-date"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Last 7 Days
                    </button>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-custom dropdown-menu-end"
                    aria-labelledby="last-date">
                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 10 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 20 Days</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="d-flex align-items-end pt-2">
        <h2 style="color: #27bec1;" class="card-title mb-0">$4,300</h2>
        <p
        class="text-success update-arrow-box border ms-2 px-1 mb-2 d-inline-block rounded fe3371">
        7%
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-arrow-up-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
            d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
        </svg>
    </span>
</p>
</div>

<div class="graph__wrapper">

    <div>

        <svg width="100%" height="25%" viewBox="0 0 300 75" stroke="#27bec1"
        stroke-linecap="round" stroke-width="2">
        <path id="react-trend-3987689759369169" d="M 8,44.875
        L 33.633003530587324,47.20476022406086
        S 48.57142857142857,48.5625 59.17919745309159,37.95706557451692
        L 78.53508826119412,18.60543442548308
        S 89.14285714285714,8 98.24972801115956,19.91909824559159
        L 120.6074148459833,49.18090175440841
        S 129.71428571428572,61.1 144.55814997787596,63.25863237354323
        L 155.44185002212404,64.84136762645677
        S 170.28571428571428,67 181.89609827687482,57.5026854544138
        L 199.24675886598232,43.3098145455862
        S 210.85714285714286,33.8125 223.5128678889946,41.86437083342505
        L 238.77284639671967,51.57312916657495
        S 251.42857142857142,59.625 266.42857142857144,59.625
        L 292,59.625"
        fill="none" class="path">
    </path>
</svg>

</div>
</div>


</div>
</div>
</div>


<div class="col-lg-3 col-sm-6 pt-3">
    <div class="card overview-chart-box border-0 shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6">
                    <p class="mb-0">NEW CLIENTS</p>
                </div>

                <div class="col-6 text-end">
                    <div class="dropdown me-3">
                        <button class="btn btn-sm dropdown-toggle" type="button" id="last-date"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Last 7 Days
                    </button>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-custom dropdown-menu-end"
                    aria-labelledby="last-date">
                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 10 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 20 Days</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="d-flex align-items-end pt-2">
        <h2 style="color: #f96e44;" class="card-title mb-0">6,782</h2>
        <p
        class="text-success update-arrow-box border mb-2 ms-2 px-1 d-inline-block rounded fe3371">
        7%
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-arrow-up-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
            d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
        </svg>
    </span>
</p>
</div>

<div class="graph__wrapper">

    <div>

        <svg width="100%" height="25%" viewBox="0 0 300 75" stroke="#f96e44"
        stroke-linecap="round" stroke-width="2">
        <path id="react-trend-3987689759369169" d="M 8,67
        L 36.058109721074715,48.453266141479105
        S 48.57142857142857,40.18181818181819 63.44204127225084,38.215888909910504
        L 74.27224444203488,36.7841110900895
        S 89.14285714285714,34.81818181818182 104.0134698436794,32.85225254627414
        L 114.84367301346346,31.420474726453136
        S 129.71428571428572,29.454545454545453 142.60553545075445,37.123683622031734
        L 157.39446454924555,45.92177092342281
        S 170.28571428571428,53.59090909090909 180.257510239457,42.3854066275244
        L 200.88534690340015,19.205502463384697
        S 210.85714285714286,8 220.38351360698155,19.586555153997146
        L 241.90220067873273,45.7588993914574
        S 251.42857142857142,57.345454545454544 264.9029561215906,50.75447911350748
        L 292,37.5"
        fill="none" class="path">
    </path>
</svg>

</div>
</div>


</div>
</div>
</div>


<div class="col-lg-3 col-sm-6 pt-3">
    <div class="card overview-chart-box border-0 shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-6">
                    <p class="mb-0">ACTIVE USERS</p>
                </div>

                <div class="col-6 text-end">
                    <div class="dropdown me-3">
                        <button class="btn btn-sm dropdown-toggle" type="button" id="last-date"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Last 7 Days
                    </button>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-custom dropdown-menu-end"
                    aria-labelledby="last-date">
                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 10 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 20 Days</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="d-flex align-items-end pt-2">
        <h2 style="color: #9e0bfe;" class="card-title mb-0">2,986</h2>
        <p class="text-danger border update-arrow-box ms-2 mb-2 px-1 d-inline-block rounded fe3371">
            -7%
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z" />
            </svg>
        </span>
    </p>
</div>

<div class="graph__wrapper">

    <div>

        <svg width="100%" height="25%" viewBox="0 0 300 75" stroke="#9e0bfe"
        stroke-linecap="round" stroke-width="2">
        <path id="react-trend-3987689759369169" d="M 8,67 L 36.96104458026804,43.30981454558621
        S 48.57142857142857,33.8125 61.22715360328032,41.86437083342505
        L 76.48713211100538,51.57312916657495
        S 89.14285714285714,59.625 103.2401207829798,54.49985045477935
        L 115.61702207416306,50.00014954522065
        S 129.71428571428572,44.875 144.65271075512698,46.23273977593914
        L 155.34728924487302,47.20476022406086
        S 170.28571428571428,48.5625 180.8934831673773,37.95706557451692
        L 200.24937397547984,18.60543442548308
        S 210.85714285714286,8 219.96401372544528,19.91909824559159
        L 242.321700560269,49.18090175440841
        S 251.42857142857142,61.1 266.41866825368,60.55502552915758
        L 292,59.625"
        fill="none" class="path">
    </path>
</svg>

</div>
</div>


</div>
</div>
</div>

</div>
<div class="row">
    <div class="col-lg-6 mt-4">
        <div class="card-body border-0 shadow-sm">
            <div class="table-responsive">
                <table id="example" class="table table-striped border table-borderless">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>

                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>

                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>

                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>

                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>

                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>

                            <td>$162,700</td>
                        </tr>
                        <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>

                            <td>$372,000</td>
                        </tr>
                        <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>

                            <td>$137,500</td>
                        </tr>
                        <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>

                            <td>$327,900</td>
                        </tr>
                        <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>

                            <td>$205,500</td>
                        </tr>
                        <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>

                            <td>$103,600</td>
                        </tr>
                        <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>30</td>

                            <td>$90,560</td>
                        </tr>
                        <tr>
                            <td>Quinn Flynn</td>
                            <td>Support Lead</td>
                            <td>Edinburgh</td>
                            <td>22</td>

                            <td>$342,000</td>
                        </tr>
                        <tr>
                            <td>Charde Marshall</td>
                            <td>Regional Director</td>
                            <td>San Francisco</td>
                            <td>36</td>

                            <td>$470,600</td>
                        </tr>
                        <tr>
                            <td>Haley Kennedy</td>
                            <td>Senior Marketing Designer</td>
                            <td>London</td>
                            <td>43</td>

                            <td>$313,500</td>
                        </tr>
                        <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>19</td>

                            <td>$385,750</td>
                        </tr>
                        <tr>
                            <td>Michael Silva</td>
                            <td>Marketing Designer</td>
                            <td>London</td>
                            <td>66</td>

                            <td>$198,500</td>
                        </tr>
                        <tr>
                            <td>Paul Byrd</td>
                            <td>Chief Financial Officer (CFO)</td>
                            <td>New York</td>
                            <td>64</td>

                            <td>$725,000</td>
                        </tr>
                        <tr>
                            <td>Gloria Little</td>
                            <td>Systems Administrator</td>
                            <td>New York</td>
                            <td>59</td>

                            <td>$237,500</td>
                        </tr>
                        <tr>
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>

                            <td>$132,000</td>
                        </tr>
                        <tr>
                            <td>Dai Rios</td>
                            <td>Personnel Lead</td>
                            <td>Edinburgh</td>
                            <td>35</td>

                            <td>$217,500</td>
                        </tr>
                        <tr>
                            <td>Jenette Caldwell</td>
                            <td>Development Lead</td>
                            <td>New York</td>
                            <td>30</td>

                            <td>$345,000</td>
                        </tr>
                        <tr>
                            <td>Yuri Berry</td>
                            <td>Chief Marketing Officer (CMO)</td>
                            <td>New York</td>
                            <td>40</td>

                            <td>$675,000</td>
                        </tr>
                        <tr>
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>

                            <td>$106,450</td>
                        </tr>
                        <tr>
                            <td>Doris Wilder</td>
                            <td>Sales Assistant</td>
                            <td>Sydney</td>
                            <td>23</td>

                            <td>$85,600</td>
                        </tr>
                        <tr>
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>

                            <td>$1,200,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Joyce</td>
                            <td>Developer</td>
                            <td>Edinburgh</td>
                            <td>42</td>

                            <td>$92,575</td>
                        </tr>
                        <tr>
                            <td>Jennifer Chang</td>
                            <td>Regional Director</td>
                            <td>Singapore</td>
                            <td>28</td>

                            <td>$357,650</td>
                        </tr>
                        <tr>
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>

                            <td>$206,850</td>
                        </tr>
                        <tr>
                            <td>Fiona Green</td>
                            <td>Chief Operating Officer (COO)</td>
                            <td>San Francisco</td>
                            <td>48</td>

                            <td>$850,000</td>
                        </tr>
                        <tr>
                            <td>Shou Itou</td>
                            <td>Regional Marketing</td>
                            <td>Tokyo</td>
                            <td>20</td>

                            <td>$163,000</td>
                        </tr>
                        <tr>
                            <td>Michelle House</td>
                            <td>Integration Specialist</td>
                            <td>Sydney</td>
                            <td>37</td>

                            <td>$95,400</td>
                        </tr>
                        <tr>
                            <td>Suki Burks</td>
                            <td>Developer</td>
                            <td>London</td>
                            <td>53</td>
                            <td>2009/10/22</td>
                            <td>$114,500</td>
                        </tr>
                        <tr>
                            <td>Prescott Bartlett</td>
                            <td>Technical Author</td>
                            <td>London</td>
                            <td>27</td>

                            <td>$145,000</td>
                        </tr>
                        <tr>
                            <td>Gavin Cortez</td>
                            <td>Team Leader</td>
                            <td>San Francisco</td>
                            <td>22</td>

                            <td>$235,500</td>
                        </tr>
                        <tr>
                            <td>Martena Mccray</td>
                            <td>Post-Sales support</td>
                            <td>Edinburgh</td>
                            <td>46</td>

                            <td>$324,050</td>
                        </tr>
                        <tr>
                            <td>Unity Butler</td>
                            <td>Marketing Designer</td>
                            <td>San Francisco</td>
                            <td>47</td>

                            <td>$85,675</td>
                        </tr>
                        <tr>
                            <td>Howard Hatfield</td>
                            <td>Office Manager</td>
                            <td>San Francisco</td>
                            <td>51</td>

                            <td>$164,500</td>
                        </tr>
                        <tr>
                            <td>Hope Fuentes</td>
                            <td>Secretary</td>
                            <td>San Francisco</td>
                            <td>41</td>

                            <td>$109,850</td>
                        </tr>
                        <tr>
                            <td>Vivian Harrell</td>
                            <td>Financial Controller</td>
                            <td>San Francisco</td>
                            <td>62</td>

                            <td>$452,500</td>
                        </tr>
                        <tr>
                            <td>Timothy Mooney</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>37</td>

                            <td>$136,200</td>
                        </tr>
                        <tr>
                            <td>Jackson Bradshaw</td>
                            <td>Director</td>
                            <td>New York</td>
                            <td>65</td>

                            <td>$645,750</td>
                        </tr>
                        <tr>
                            <td>Olivia Liang</td>
                            <td>Support Engineer</td>
                            <td>Singapore</td>
                            <td>64</td>

                            <td>$234,500</td>
                        </tr>
                        <tr>
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>

                            <td>$163,500</td>
                        </tr>
                        <tr>
                            <td>Sakura Yamamoto</td>
                            <td>Support Engineer</td>
                            <td>Tokyo</td>
                            <td>37</td>

                            <td>$139,575</td>
                        </tr>
                        <tr>
                            <td>Thor Walton</td>
                            <td>Developer</td>
                            <td>New York</td>
                            <td>61</td>

                            <td>$98,540</td>
                        </tr>
                        <tr>
                            <td>Finn Camacho</td>
                            <td>Support Engineer</td>
                            <td>San Francisco</td>
                            <td>47</td>

                            <td>$87,500</td>
                        </tr>
                        <tr>
                            <td>Serge Baldwin</td>
                            <td>Data Coordinator</td>
                            <td>Singapore</td>
                            <td>64</td>

                            <td>$138,575</td>
                        </tr>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>

                            <td>$125,250</td>
                        </tr>
                        <tr>
                            <td>Zorita Serrano</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>56</td>

                            <td>$115,000</td>
                        </tr>
                        <tr>
                            <td>Jennifer Acosta</td>
                            <td>Junior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>43</td>

                            <td>$75,650</td>
                        </tr>
                        <tr>
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>

                            <td>$145,600</td>
                        </tr>
                        <tr>
                            <td>Hermione Butler</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>47</td>

                            <td>$356,250</td>
                        </tr>
                        <tr>
                            <td>Lael Greer</td>
                            <td>Systems Administrator</td>
                            <td>London</td>
                            <td>21</td>

                            <td>$103,500</td>
                        </tr>
                        <tr>
                            <td>Jonas Alexander</td>
                            <td>Developer</td>
                            <td>San Francisco</td>
                            <td>30</td>

                            <td>$86,500</td>
                        </tr>
                        <tr>
                            <td>Shad Decker</td>
                            <td>Regional Director</td>
                            <td>Edinburgh</td>
                            <td>51</td>

                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Michael Bruce</td>
                            <td>Javascript Developer</td>
                            <td>Singapore</td>
                            <td>29</td>

                            <td>$183,000</td>
                        </tr>
                        <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>

                            <td>$112,000</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4">
        {{--                    <button class="btn show-toster btn-primary">Show toster</button>--}}
    </div>
</div>


</div>
</section>
@endsection
