/// <summary>
/// API Request to update a user's profile on PayFabric Receivables
/// </summary>
/// <param name="json">JSON string to be sent</param>
/// <param name="URL">URL of the PayFabric Receivables site</param>
/// <param name="token">PayFabric Receivables token object</param>
/// <param name="responses">Returned response object</param>
public void UpdateUserProfile(string json, string URL, Token token, ref Response responses)
{
	// Sample request and response
	// ------------------------------------------------------
	// Go to https://github.com/PayFabric/APIs/blob/master/Receivables/Sections/APIs/API/Accounts.md#update-an-users-profile for more details about request and response.
	// Go to https://github.com/PayFabric/APIs/blob/master/Receivables/Sections/Objects/AccountUser.md#AccountUserPost for more details about the object.
	// ------------------------------------------------------
	
	var client = new RestClient(URL + "API/users/profile");
	var request = new RestRequest(Method.POST);
	request.AddHeader("content-type", "application/json");
	request.AddHeader("authorization", "Bearer " + token.access_token);
	request.AddParameter("application/json", json, ParameterType.RequestBody);
	IRestResponse response = client.Execute(request);

	if (response.StatusCode == System.Net.HttpStatusCode.OK)
	{
		try
		{
			JsonDeserializer deserial = new JsonDeserializer();
			responses = deserial.Deserialize<Response>(response);
		}
		catch
		{
			responses.Message = "Token validation failed";
			responses.Result = "false";
		}
	}
	else
	{
		responses.Message = "Bad HTTP Request";
		responses.Result = "false";
	}
}
