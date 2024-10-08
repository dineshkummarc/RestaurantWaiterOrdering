
package fortin.restaurant.digital.menu.activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;

import com.example.reeva.restaurant.R;
import fortin.restaurant.digital.menu.model.CustCuisineListPojo;
import fortin.restaurant.digital.menu.model.M;
import fortin.restaurant.digital.menu.webservices.APIService;
import fortin.restaurant.digital.menu.webservices.CustCuisineListAPI;

import java.util.ArrayList;
import java.util.List;

import retrofit.Callback;
import retrofit.RetrofitError;
import retrofit.client.Response;

public class CustCuisine extends AppCompatActivity {

    private RecyclerView mRecyclerView;
    private RecyclerView.Adapter recycleradapter;
    private RecyclerView.LayoutManager mLayoutManager;
    public static String cuiposid;
    public List<CustCuisineListPojo> cuisinelist = new ArrayList<CustCuisineListPojo>();
    ArrayList<String> cuisineidlist = new ArrayList<String>();
    ArrayList<String> cuisinenamelist = new ArrayList<String>();
    ArrayList<String> cuisineimglist = new ArrayList<String>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cust_cuisini_list);
        mRecyclerView = (RecyclerView) findViewById(R.id.my_recycler_view);
        mRecyclerView.setHasFixedSize(true);
        mLayoutManager = new LinearLayoutManager(this);
        mRecyclerView.setLayoutManager(mLayoutManager);

        getSupportActionBar().setHomeButtonEnabled(true);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle("Table Name: " + DataManager.tablename);
        getSupportActionBar().setSubtitle("Order By: " + M.getUsername(this));



        getCustCuisine();

    }



    // get custcuisinelist

    private void getCustCuisine() {

        M.showLoadingDialog(CustCuisine.this);
        CustCuisineListAPI mCommentsAPI = APIService.createService(CustCuisineListAPI.class);

        mCommentsAPI.getUserPosts(new Callback<List<CustCuisineListPojo>>() {



            @Override
            public void success(List<CustCuisineListPojo> custCuisineListPojos, Response response) {
                if (custCuisineListPojos != null) {


                    cuisinelist = custCuisineListPojos;


                    for (CustCuisineListPojo cuisinedata : cuisinelist) {
                        String cuisineid=cuisinedata.getCusineid();
                        String cuisinename=cuisinedata.getCusinename();
                        String cuisineimg=cuisinedata.getCusineimage();
                        cuisineidlist.add(cuisineid);
                        cuisinenamelist.add(cuisinename);
                        cuisineimglist.add(cuisineimg);

                    }
                }
                recycleradapter=new RecycleCuisineAdapter(cuisinelist,cuisinenamelist,cuisineimglist,CustCuisine.this);
                mRecyclerView.setAdapter(recycleradapter);


                M.hideLoadingDialog();
            }

            @Override
            public void failure(RetrofitError error) {

                M.hideLoadingDialog();
                Log.e("error", error.getMessage());

            }
        });
    }

    @Override
    public void onBackPressed()
    {
        Intent i = new Intent(this, OrderPlaceScreen.class);
        finish();
        startActivity(i);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
//        getMenuInflater().inflate(R.menu.menu_cust_dishes, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == android.R.id.home) {
            Intent i = new Intent(this, OrderPlaceScreen.class);
            finish();
            startActivity(i);
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}

