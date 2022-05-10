@extends('docs::layouts.frontend')

@section('title', 'Rules and Support')
@section('content')
<div class="container py-4 py-md-5">
	<div class="row">
		<div class="col-md-12">
			<h1>Rules and Support</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<h2>Our Rules</h2>
			<p>At Simply Connect we try to be relatively laid back and relaxed with our flights however we do expect pilots to abide by the below basic rules</p>
            <h3>Membership Policy</h3>
            <p>In order to join us and make your experience worthwhile you must:
			<ul>
				<li>Be 15 years or older.</li>
                <li>Be a member of our Discord server and provide your Discord username on registration.</li>
                <li>Have a legal, working version of Microsoft Windows with at least one of the following simulators: X-Plane 11, Microsoft Flight Simulator 2020, FSX, or Prepar3D.</li>
                <li>Complete your first flight with us within 30 days of joining.</li>
			</ul>
            <h3>Conduct and Behaviours Policy</h3>
            <p>All pilots and staff must:</p>
			<ul>
				<li>Be friendly and respectful to fellow pilots and staff.</li>
                <li>Not act in a way that causes offence to others.</li>
                <li>Be willing to contribute to the Simply Connect community in a positive manner.</li>
                <li>When representing the virtual airline not act in any way inappropriate or in a way that could tarnish the reputation of Simply Connect or anyone connected to Simply Connect.</li>
			</ul>
            <p>Anyone acting inappropriately will be removed from the airline.</p>
            <h3>Minimum flight requirements and inactivity Policy</h3>
            <p>Pilots are expected to fly their first flight within 30 days of joining and then at least every 30 days thereafter.</p>
            <p>If you are unable to meet these minimum requirements, then we can set your account to on leave upon request via a ticket raised on the Discord server as per the help and support section. Setting your account to on leave ensures you do not lose your account or your activity. It is your responsibility to inform us of any extended leave.</p>
            <p>Anyone who does not file a flight within 30 days of their last one or from joining and is not on leave and does not inform us of an extended leave will have their account set to inactive. All inactive accounts are deleted 30 days after this.</p>
            <p>If you are on leave or inactive then to become active again simply fly a flight and your account status will be restored</p>
            <p>Deleted accounts are irrecoverable along with any record of flights flown with Simply Connect.<p>
            <h3>Flying Policy</h3>
            <p>Where possible all flights should be one of our scheduled flights however we currently allow pilots to fly their own custom/charter flight as they wish. Additionally pilots should ensure they are aware of the following notes:</p>
            <ul>
                <li>Pilots must fly the same aircraft they pick when booking the flight on the acars app.</li>
                <li>Pilots should check the latest NOTAMs on the website to keep up to date with changes.</li>
                <li>Pilots should keep their ACARS software up to date when prompted.</li>
                <li>Pilots should ensure they use the flight plan generation on the website or directly on a flight planning tool like Simbrief to ensure they plan the most efficenet route.</li>
                <li>Only flights filed within the ACARs app are accepted, any manual pireps will be rejected</li>
            </ul>
            <p>Pilots should also be aware that flight reports are checked and audited and may be rejected if the wrong aircraft is used or there are concerns over the validity of the flight report. Consistently filing wrong reports may lead to the downranking or suspension of a pilot.</p>

            <h3>Flying Online Policy</h3>
            <p>Flying online via one of the virtual air traffic control networks allows you to experience the next level of immersion with simulator flying. While you don't need to be a real-life pilot to fly online we highly recommend you are comfortable with the below aspects of flying before taking to an online network:</p>
            <ul>
                <li>You are comfortable with the simulator you are using and the aircraft you are flying.</li>
                <li>You have an understanding of how air traffic control works and the phraseology involved.</li>
                <li>You are able to fly SIDs/STARs and understand an IFR flight plan.</li>
            </ul>
            <p>For more details on flying online with simply connect please see our dedicated <a href="/docs/flying-online">flying online page</a> (coming soon!)</p>
		</div>
		<div class="col-md-4">
			<h3>Help and Support</h3>
			<p>Raise a ticket via "#va-support-tickets" for support with the following:</p>
            <ul>
                <li>Help using the website.</li>
                <li>Help using the tracking app (ACARS) (attach your log file!).</li>
                <li>Reporting bugs or issues.</li>
                <li>Feedback - Good and Bad.</li>
                <li>Requesting leave for over 30 days.</li>
                <li>Any other issues or concerns.</li>
            </ul>
            <p>Alternatively you can also email:</p>
            <p><a href="mailto:support@simplyconnectva.com"><i class="fas fa-envelope"></i> support@simplyconnectva.com</a></p>
            <p>Raise a ticket via <mark>#ask-the-pilot</mark> for help with the following:</p>
            <ul>
                <li>Help/advice flying an aircraft.</li>
                <li>Understanding how a particular system works.</li>
                <li>Dealing with emergencies.</li>
            </ul>
		</div>
	</div>
</div>
@endsection