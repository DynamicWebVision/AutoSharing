@extends('layouts.internal')

@section('content')
<div id="main-account">
    <acount-status></acount-status>


</div>

<template  id="social-media-app">
    <section>
        @{{dog}}
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 text-center">
                    <h4 class="uppercase mb80">  Linked Accounts @{{dog}}</h4>
                    <div class="tabbed-content icon-tabs">
                        <ul class="tabs">
                            <li class="active">
                                <div class="tab-title">

                                    <span><i class="fa fa-twitter icon" aria-hidden="true"></i> Twitter</span>
                                </div>
                                <div class="tab-content">
                                    <p v-if="accounts.twitter">
                                        @{{accounts.twitterName}}
                                    </p>
                                    <p v-else>
                                        You have not linked a twitter account.  <a href="/twitter/login">Add Account</a>.
                                    </p>



                                </div>
                            </li>
                            <li>
                                <div class="tab-title">
                                    <i class="ti-package icon"></i>
                                    <span>Approach</span>
                                </div>
                                <div class="tab-content">
                                    <p>
                                        Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="tab-title">
                                    <i class="ti-stats-up icon"></i>
                                    <span>Culture</span>
                                </div>
                                <div class="tab-content">
                                    <p>
                                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="tab-title">
                                    <i class="ti-layout-media-center-alt icon"></i>
                                    <span>Method</span>
                                </div>
                                <div class="tab-content">
                                    <p>
                                        Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--end of icon tabs-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
</template>

@endsection

@section('javascript')
<script src="manage_account.js"></script>
@endsection