<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Insights</title>
</head>

<body>
  <table style="width: 100%; max-width: 600px; margin: 0 auto; border-collapse: collapse; background-color: #f5f5f5;">
    <tr>
      <td style="padding: 20px; text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
        <!-- <img src="https://orionesolutions.com/wp-content/themes/astra/assets/images/orion-esolutions-logo.svg" alt="Orion eSolutions Inc." style="display: block;height: 30px; max-width: 100%;">
 -->
      </td>
    </tr>
    <tr>
      <td style="padding: 20px;">
        <h1 style="margin-top: 4px; font-size: 18px; font-weight: bold;">Dear valued customer,</h1>
        <p style="margin-top: 4px; font-size: 16px; line-height: 1.5;">
          We have completed the analysis and have compiled the results free only for you.
        </p>

        <p style="margin-top: 4px; font-size: 16px; line-height: 1.5;">
          We hope that this information is helpful and encourage you to take action to make the necessary improvements. If you have any questions or need further assistance, please do not hesitate to reach out to us.
        </p>

        <p style="margin-top: 4px; font-size: 16px; line-height: 1.5;">
          Thank you again for your time and we look forward to helping you improve your website.
        </p>

      </td>
    </tr>
    <tr>
      <td style="padding: 20px;">
        <p>Site: <a href="{{ $data['site_url'] }}">{{ $data['site_url'] }}</a></p>

        @if($data['mobile']['is_data'])

        <p>{{ $data['mobile']['strategy'] }}</p>

        <div class="columns" style="justify-content: space-evenly !important; display: flex; padding:10px">

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['mobile']['categories']['performance']['textc'] ?>; font-size: 2rem;">{{ $data['mobile']['categories']['performance']['score'] }}</p>
            </div>
            <h3>{{ $data['mobile']['categories']['performance']['title'] }}</h3>
          </div>

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['mobile']['categories']['accessibility']['textc'] ?>; font-size: 2rem;">{{ $data['mobile']['categories']['accessibility']['score'] }}</p>
            </div>
            <h3>{{ $data['mobile']['categories']['accessibility']['title'] }}</h3>
          </div>

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['mobile']['categories']['best_practices']['textc'] ?>; font-size: 2rem;">{{ $data['mobile']['categories']['best_practices']['score'] }}</p>
            </div>
            <h3>{{ $data['mobile']['categories']['best_practices']['title'] }}</h3>
          </div>

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['mobile']['categories']['seo']['textc'] ?>; font-size: 2rem;">{{ $data['mobile']['categories']['seo']['score'] }}</p>
            </div>
            <h3>{{ $data['mobile']['categories']['seo']['title'] }}</h3>
          </div>

        </div>

        <hr>
        <br>
        @endif

        @if($data['desktop']['is_data'])
        <p>{{ $data['desktop']['strategy'] }}</p>
        <div style="justify-content: space-evenly !important; display: flex; padding:10px">

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['desktop']['categories']['performance']['textc'] ?>; font-size: 2rem;">{{ $data['desktop']['categories']['performance']['score'] }}</p>
            </div>
            <h3>{{ $data['desktop']['categories']['performance']['title'] }}</h3>
          </div>

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['desktop']['categories']['accessibility']['textc'] ?>; font-size: 2rem;">{{ $data['desktop']['categories']['accessibility']['score'] }}</p>
            </div>
            <h3>{{ $data['desktop']['categories']['accessibility']['title'] }}</h3>
          </div>

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['desktop']['categories']['best_practices']['textc'] ?>; font-size: 2rem;">{{ $data['desktop']['categories']['best_practices']['score'] }}</p>
            </div>
            <h3>{{ $data['desktop']['categories']['best_practices']['title'] }}</h3>
          </div>

          <div style="text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
            <div>
              <p style="color: <?= $data['desktop']['categories']['seo']['textc'] ?>; font-size: 2rem;">{{ $data['desktop']['categories']['seo']['score'] }}</p>
            </div>
            <h3>{{ $data['desktop']['categories']['seo']['title'] }}</h3>
          </div>

        </div>
        @endif

      </td>
    </tr>

    <tr>
      <td>
        <div>

        </div>
      </td>
    </tr>

    <tr>
      <td style="padding: 20px;">
        <br>
        <p>
          Sincerely,
        </p>
        <p>Orion Team</p>
      </td>
    </tr>
    <tr>
      <td style="background-color:antiquewhite; padding: 20px; text-align: center; margin-right:20px; border: 1px solid lightgray;
    padding: 6px;">
        <a style="margin: 0; font-size: 14px;" href="https://orionesolutions.com/">Orion eSolutions Inc.</a>
      </td>
    </tr>
  </table>


</body>

</html>