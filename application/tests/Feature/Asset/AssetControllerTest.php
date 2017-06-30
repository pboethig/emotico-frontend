<?php

namespace Tests\Feature\Asset;

use App\Models\Asset;
use App\Models\AssetsCroppings;
use App\Models\User;

use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class AssetControllerTest extends FeatureTestAbstract
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGetDropzoneConfig()
    {
        $response = $this->actingAs($this->user)->get('/admin/assets/getUploadFormConfig');

        $response->assertStatus(200);
    }

    /**
     * @expectedException \ErrorException
     */
    public function testsaveCropping()
    {
        /**
         * Create asset
         */
        $asset = new Asset(['uuid'=>uniqid(), 'version'=>'atestasset','extension'=>'.jpg']);
        $asset->save();

        /**
         * Mock thumbnail creation event
         */

        $canvasData = json_decode('{"left": 0, "top": 84.9375, "width": 498, "height": 280.125, "naturalWidth": 320, "naturalHeight":234}');
        $browserimagedata = json_decode('{"left": 0, "top": 84.9375, "width": 498, "height": 280.125, "naturalWidth": 320, "naturalHeight":234}');

        $message = new \stdClass();
        $message->ticketId = $asset->uuid;
        $message->uuid = $asset->uuid;
        $message->version = $asset->uuid.'_' . uniqid();
        $message->extension = 'png';
        $message->user_id = $this->user->id;
        $message->canvasdata = $canvasData;
        $message->browserimagedata = $browserimagedata;

        /**
         * call Save Cropping controller
         */
        $response = $this->actingAs($this->user)->post('/admin/assets/saveCropping', ['message'=>$message]);

        $response->assertSeeText('404 Not Found');

        $assetCropping = json_decode($response->baseResponse->getContent());

        /**
         * test
         */
        $this->assertNotNull($assetCropping->asset_id);
        $this->assertNotNull($assetCropping->user_id);
        $this->assertNotNull($assetCropping->id);
        $this->assertNotNull($assetCropping->canvasdata);
        $this->assertNotNull(json_decode($assetCropping->canvasdata));

        /**
         * Test relations
         */
        $storedCropping = AssetsCroppings::find($assetCropping->id);
        $this->assertEquals($storedCropping->user_id, $message->user_id);


        //test assetrelation
        $this->assertEquals($storedCropping->asset()->uuid, $asset->uuid);
        $this->assertNotEmpty($storedCropping->canvasdata);
        $this->assertNotEmpty(json_decode($storedCropping->canvasdata));


        /** @var  $relatedAsset Asset*/
        $user = User::find($assetCropping->user_id);
        $relatedAsset = Asset::find($storedCropping->asset()->id);
        $this->assertGreaterThan(0, $relatedAsset->croppings()->count());

        //test usercroppings
        $userCroppings = $relatedAsset->getUserCroppings($user);

        $this->assertGreaterThan(0, $userCroppings->first()->id);

        /**
         * Delete testdata
         */
        AssetsCroppings::find($assetCropping->id)->delete();

        $asset->delete();
    }

    public function testStoreBase64Image()
    {
        $filename='test.png';

        $base64Image = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADhCAYAAADmtuMcAAAOZElEQVR4Xu3dzW8bRRgH4EnsJJQmUKkceuTYGxdO9C/n3GNPSPwBlVAPPZWKNCgf3qAxuAqFNs7s7O58PD5Vwjsz7/NO+HnX9vpgGIbb4EGAAAECBB4ocCBAHijm6QQIECCwFRAgNgIBAgQIJAkIkCQ2BxFoU+Dg4CDc3rqq3WZ381clQPKbGpFAlQIxPOJjGIaw+3eVhVj0bAICZDZqExEgQKAtAQHSVj9VQ4AAgdkEBMhs1CYiQIBAWwICpK1+qoYAAQKzCQiQ2ahNRIAAgbYEBEhb/VQNAQIEZhMQILNRm4gAAQJtCQiQtvqpmgoF4ncufv311/D8+fOwXq99ka/CHva6ZAHSa+fVTYAAgZECAmQkoMMJECDQq4AA6bXz6iZAYHGBeN+xmm8bI0AW30LTLcCN8aazNTIBAm7n3uweEB7NtlZhBIoRcAZSTCvyL+Tdu3fh22+/DYeHh/kHL2zEu5cB3I68sOZYTrMC/wqQzWYTVqtVs8X2Vtjl5WU4Pj6u+hprbz1TL4GaBJyB1NStB6x1dwkrhkh8UXB0dOT7BQ/w81QCBO4XECD3G1X9jHg5J17Cclmn6jZ2v3jv6ZW5BQRImX2xKgIE/hHYvb/lRVB5W0KAlNcTKyJA4BMBZyBlbolJA0TTy2y6VREgQCCHwKQBkmOBxiBAgACBMgUmDZDz8/NwenpaZuVWRYAAAQKjBCYNEJewRvVmsoO9KTkZrYEJdCUwaYB0JVlJsZ/euM0nWyppnGUSKFBAgBTYlCmXFAPk5uZm+8NF8TFVgOQ4+xyGYfslyKnWOKWzsQn0ICBAeujyJzXWct+o2m913eHWUnJnAgKkt4YfHHys2Cv7zpqvXAKZBQRIZlDDESBAoBcBAdJLp9VJgACBzAICJDOo4doWyPHhgLaFVLePQCv7SIDs023PIRDC9ndVvG9kK4wVqOVDLPvUKUD2UfIcAgQIZBRo5cWIAMm4KQxFgACBngQESE/dVisBAt0JxLOd+KXcT+9CkQNCgORQNAYBAgQKFZjy3ncCpNCmWxaBXgRaeT+gl37drVOA9Nh1NRMgQCCDwGcDZMrTngzrNsTEAvo/MbDhCTQg8MUA8Zn3BjqcWILLColwDiPQkcBel7C8Gu1oRyiVAIEHCbT0xcAHFR6/XDsMw+19B3k1ep+Q/06AQK8C8SOym80mHB0ddUewV4B0p6JgAgQIELhXQIDcS+QJBAgQIPB/AgLEviBAgACBJAEBksTmIAIECBAQIPYAAQIECCQJCJAkNgcRIECAgACxBwgQIEAgSUCAJLE5iAABAgQEiD1AgAABAkkCAiSJzUEECBAgIEDsAQIEqhaIN309PDwMbv46fxsFyPzmZiRAIJOAG71mgkwcRoAkwjmMAIH9BfyPfn+rmp4pQGrqlrUSqFDA3bwrbNqeSxYge0J5GgEC6QJCJN2u5CMFSMndsTYCjQgIkEYa+UkZAqTNvqqKAAECkwvMGiDxl7uur6/DycnJ5IWZgAABAgSmFZg1QC4vL8NXX33l89rT9tToBAgQmEVg1gCZpSKTECBAgMAsAgJkFmaTECBAoD0BAdJeT1VEgACBWQQEyCzMJiFAgEB7AgKkvZ6qiAABArMICJBZmE1CgACB9gQESHs9VREBAgRmERAgszCbhAABAu0JCJD2eqoiAgQIzCIgQGZhNgkBAgTaExAg7fVURQQIEJhFQIDMwmwSAgQItCcgQNrrqYomFPC7FhPiGro6ga4CJP7xxzsC724nf3t7W13DLHg5gbh/4s8RrFarsPuN7+VWY2YCywt0FSCRe/cK0ivJ5TdfjSuwb2rsmjVPJdBdgEwFaVwCBAj0JiBAeuu4egkQIJBJQIBkgjQMAQIEehMQIL11XL0ECBDIJCBAMkEahgABAr0JCJDeOq5eAgQIZBIQIJkgDUOAAIHeBARIbx1XLwECBO58J24MhgAZo+dYAgQIVCiwu5PC2LtxCJAKm2/JBAgQKEFAgJTQBWsgQIBAhQICpMKm7bvkXKep+87neQQI9CUgQBrud+qN/y4uLsLjx4/D2OujDdMqjQCB+Eb8MAzuaW4rfBSI4fHy5cvw008/hbOzMzIECBD4rIAAsTn+I/Dhw4ftGYgHAQIEviQgQOwPAgQIEEgSWCxA7v6im2vtSb1zEAECBBYVWCxAYtU3NzdhvV4vCmByAgQIEEgTWDRA0pbsKAIECBAoQUCAlNAFayBAgECFAosFiC+5VbhbLJkAAQJ3BBYLEF0gQIAAgboFBEjd/bN6AgQILCYgQEbQ//LLL+GHH34YMYJDCRAgUK+AABnRu9R7TY2Y0qEECBAoRkCATNyKXcjEL0ve/fLkxNMangABApMLCJDJiU1AgACBNgUESJt9VRUBAgQmFxAgkxObgAABAm0KCJA2+6oqAgQITC4gQCYnNgEBAgT2E6jtk50CZL++ehYBAgQmFdiFxzAM4fDwcNK5cg0uQHJJGocAAQIjBZyBjAR0OAECBAjUIeAMpI4+WSUBAgSKExAgxbXEgggQIFCHgADJ2Kfdm1+1XcfMSGAoAgQaEbi8vAx//HEevvvuadhsNmG1Wv2nMgGSqdlCIxOkYQhMKODv9GG45+fn4fT09LMHCZCHeXo2AQIVC8QAia+ma/mYbOnUAqT0DlkfAQLZBGKAxEvN7oydh1SA5HE0CgECBLoTECDdtVzBBAgQyCMgQPI4GoUAAQLdCQiQ7lquYAIECOQRECB5HI1CgACB7gQESHctVzABAgTyCAiQPI5GIUCAQHcCAqS7liuYAAECeQQESB5HoxAgQKA7AQHSXcsVTIAAgTwCAiSPo1EIECDQnYAA6a7lCiZAgEAeAQGSx9EoXxC4vb118zo7hECDAgKkwaYqiQABAnMIdBEgbuE8x1YyBwECvQl0EyBXV1dhvV6HeDnFj8n0ts3VO4WAX/ebQrWuMbsIkLpaYrUE6hD4XIAIljr6l2OVAiSHojEIdCYgPDpr+GfKFSD2AQECBAgkCQiQJDYHESBAgIAAsQcIECBAIElAgCSxOYgAAQIEBIg9QIAAAQJJAgIkic1BBAgQICBA7AECBAgQSBIQIElsDiJAgAABAWIPjBZwt93RhAYgUKWAAKmybRZNgACB5QUEyPI9sAICBAhUKSBAqmybRRMgQGB5AQGyfA+sgAABAlUKCJAq22bRBAgQWF6giwCJnxKKj3gLag8CBAgQuF9gn9916SJAItXr16/D999/f7+aZxAgQKBzgX3CY/uifBiGv1+eN/y4e+axOxtpuFylESBAYBaBLgJks9mEi4uLcHp6uv09dCEyy94yCQECjQt0ESAxMGKIxPBYrVYCpPFNrTwCBOYR6CJAttfq/nkD3dnHPBvLLAQItC/QTYC030oVEiBAYF6B5gIknmHES1VXV1fh+Pi4uMtV8Uxodzlt3labjQABAnkFmg2QV69ehR9//DGvVobRXErLgGgIAgSKEGguQIpQtQgCBAh0ICBAOmiyEgkQIDCFgACZQtWYBAgQ6EBAgHTQZCX2LXB9fR2GYdh+qMT94PreC7mrFyC5RY1HoCCB3af+4qcT45doPQjkFBAgOTWNRaAwgXjm8f79++1tfEr8WHthXJbzQAEB8kAwTydAgACBvwUEiJ1AgAABAkkCAiSJzUEECBAgIEDsAQIECBBIEhAgSWwOIkCAAAEBYg8QIECAQJKAAElicxABAgQICBB7gAABAgSSBARIEpuDCBAgQECA2AMECBAgkCQwe4Dc3NyE9XqdtFgHESBAgEA5ArMGSLyxW7ypmwcBAgQI1C8wa4DUz6UCAgQIENgJCBB7oWgBZ61Ft8fiOhcQIJ1vgJLL3/34kcueJXfJ2noWECA9d7/w2q+ursLJyYn3zQrvk+X1KyBA+u29ygkQIDBKQICM4nMwAQIE+hUQIP32XuUECBAYJSBARvE5mAABAv0KCJB+e69yAgQIjBIQIKP4HEyAAIF+BQRIv71XOQECBEYJCJBRfA4mUIbA7kuXcTW+eFlGT3pYhQDpoctqbFpgFx5//vlnePTo0bZWIdJ0y4spToAU0woLIZAuEEPk7du34ezs7GOIpI/mSAL7CQiQ/Zw8i0DxAruzjruXs4pftAVWLSBAqm6fxRMgQGA5AQGynL2ZCRAgULWAAKm6fRZPgACB5QQEyHL2ZiZAgEDVAgKk6vZZPAECBJYTECDL2ZuZAAECVQsIkKrbZ/EECBBYTkCALGdvZgIECFQtIECqbp/FEyBAYDkBAbKcvZkJECBQtYAAqbp97Sz+999/D19//XU4Pj5upyiVEGhcQIA03uBayru6uhIetTTLOgn8IyBAbAUCjQjEmyi6jXsjzaykDAFSSaMss12B3a3Ynz59GlarVXKhAiSZzoGJAgIkEc5hBMYK3L3t+s8//xxevHix/S2Pw8PDsUM7nsAsAgJkFmaTEPi3QAyP+AuCJycnIf77zZs34dmzZ6POQBgTmFtAgMwtbr7uBWJgDMMQfvvtt/DkyZPwzTffbN+78ENQ3W+NWQHiHhx7titAZm2ZyQiEj0ER/4BjaHjvwq5YQiDHixYBskTnzEmAAIEEgd2n7HZnDnN86m53Zvx/cwmQhCY6hAABAksJXF5ebi89xS/dzhEgXzpTESBL7QLzEiBA4IEC8WwgBkh8lHDXBgHywAa2+nTX4VvtrLpaFCjl71WAtLi7Emp6//799hNBc5wSJyzPIQQIFCggQApsyhJL2mw2voOwBLw5mxHI8amm2jAESG0ds14CBIoUECBFtsWiCNQnUMo16vrkrLgmAWcgNXXLWqsRECDLtiqeDcSPunpPb9o+CJBpfY1OgMACAvE9vfV6LUAmthcgEwMbnkCLAjW8wncWOP3OEyDTG5uBQHMCX7q9RXPFKuizAgLE5iBAgACBJIG/AI5bpAbUCrCuAAAAAElFTkSuQmCC";

        $response = $this->actingAs($this->user)->post('/admin/assets/storeBase64Image', ['filename'=>$filename, 'base64Image'=>$base64Image]);
        $response->assertStatus(200);
    }

    public function testDeleteCropping()
    {
        $assetCroppings = new AssetsCroppings(['asset_id'=>99999, 'user_id'=>1,'cropping_hash'=>uniqid(),'canvasdata'=>'{}']);
        $assetCroppings->save();


        $response = $this->actingAs($this->user)->get('/admin/assets/' . $assetCroppings->id . '/deleteCropping');
        $response->assertStatus(200);
    }
}
