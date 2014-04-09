  <!-- Default panel contents -->
<h4>A/C. {{ $account->getAccountNo() }} ({{ ucfirst($account->getType()) }} Account)</h4>
<!-- Table -->
<table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Transaction Date</th>
          <th>Transfer Type</th>
          <th>Summary</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($account->getTransactions() as $transfer)
          <tr>
              <td>{{$transfer->getId()}}</td>
              <td>{{$transfer->getCreateTime()->format("Y-m-d H:i:s")}}</td>
              <td>{{$transfer->getType()}}</td>
              <td>{{$transfer->getDescription()}}</td>
              <td>{{$transfer->getAmount()}}</td>
          </tr>
          @endforeach
      </tbody>
</table>
<br/>
<br/>
<!-- Table -->
<table class="table">
      <tbody>
          @foreach ($account->getCards() as $card)
          <tr>
              <td>Master Card - {{$card->getCardNo()}}</td>
              <td>Expire {{$card->getExpireDateToString()}}</td>
              <td>{{$card->getTypeToString()}}</td>
              <td><a href="" class="btn btn-primary">Change Pin</a></td>
          </tr>
          @endforeach
      </tbody>
</table>