package fortin.restaurant.digital.menu.activities;

import android.content.Context;
import android.graphics.Color;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.reeva.restaurant.R;
import fortin.restaurant.digital.menu.model.DeletePojo;
import fortin.restaurant.digital.menu.model.DishOrderPojo;
import fortin.restaurant.digital.menu.model.M;
import fortin.restaurant.digital.menu.webservices.APIService;
import fortin.restaurant.digital.menu.webservices.DeleteAPI;

import java.util.ArrayList;
import java.util.List;

import retrofit.Callback;
import retrofit.RetrofitError;
import retrofit.client.Response;

/**
 * Created by Reeva on 9/24/2015.
 */
public class RecyclerViewAdapter extends RecyclerView.Adapter<RecyclerViewAdapter.ContentViewHolder> {
    View view;
    ContentViewHolder contentviewholder;
    DishOrderPojo order;
    private static String LOG_TAG = "MyRecyclerViewAdapter";
    String actorderdetailid;
    int quan;
    public static List<DishOrderPojo> dishorederlist = new ArrayList<DishOrderPojo>();
    Context mcontext;


    public                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      RecyclerViewAdapter(Context mcontext, List<DishOrderPojo> dishorederlist ) {
        this.dishorederlist = dishorederlist;
        this.mcontext = mcontext;
    }


    public static class ContentViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener {

        TextView txtid, txtdishname, txtqty;
        Button imgdinc, imgddec, btndelete;

        public ContentViewHolder(View itemView) {
            super(itemView);
            txtid = (TextView) itemView.findViewById(R.id.txtdishid);
            txtdishname = (TextView) itemView.findViewById(R.id.txtdishname);
            txtqty = (TextView) itemView.findViewById(R.id.txtqty);
            btndelete = (Button) itemView.findViewById(R.id.btndelete);
            imgdinc = (Button) itemView.findViewById(R.id.imgdinc);
            imgddec = (Button) itemView.findViewById(R.id.imgddec);
            itemView.setOnClickListener(this);

        }

        @Override
        public void onClick(View v) {

        }
    }


    @Override
    public RecyclerViewAdapter.ContentViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.custom_dish_recycle_new, parent, false);

        contentviewholder = new ContentViewHolder(view);
        return contentviewholder;

    }

    @Override
    public void onBindViewHolder(final RecyclerViewAdapter.ContentViewHolder holder, final int position) {


        holder.imgdinc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                quan = Integer.valueOf(holder.txtqty.getText().toString());

                quan++;
                holder.txtqty.setText(quan + "");
                dishorederlist.get(position).setQty(""+quan);
            }

        });
        holder.imgddec.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                quan = Integer.valueOf(holder.txtqty.getText().toString());
                if (quan == 1) {
                    return;
                } else {
                    quan--;
                    holder.txtqty.setText(quan + "");
                    dishorederlist.get(position).setQty(""+quan);
                }
            }
        });
        if (dishorederlist.get(position).isnew()) {

            holder.imgddec.setVisibility(View.VISIBLE);
            holder.imgdinc.setVisibility(View.VISIBLE);
            holder.btndelete.setVisibility(View.VISIBLE);
            holder.btndelete.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    dishorederlist.remove(position);
                    notifyItemChanged(position);
                    notifyDataSetChanged();
                }
            });

            holder.txtid.setText(dishorederlist.get(position).getDishid() + "");

            holder.txtdishname.setText(dishorederlist.get(position).getDishname() + "");

            holder.txtqty.setText(dishorederlist.get(position).getQty() + "");

            Log.e("here-1-", dishorederlist.get(position).getDishname());
            Log.e("here-2-", dishorederlist.get(position).getQty());
        } else {
            holder.imgdinc.setVisibility(View.INVISIBLE);
            holder.imgddec.setVisibility(View.INVISIBLE);
            holder.btndelete.setVisibility(View.INVISIBLE);
                actorderdetailid=dishorederlist.get(position).getOrderdetailid();
                Log.e("orderdetailid", dishorederlist.get(position).getOrderdetailid());

            if(dishorederlist.get(position).getStatus().equals("0")) {
                holder.btndelete.setVisibility(View.VISIBLE);

                holder.btndelete.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        //  Toast.makeText(context,"delete",Toast.LENGTH_LONG).show();
                        getDeleteOrder(position);
                    }
                });
            } if(dishorederlist.get(position).getStatus().equals("1")) {
                holder.btndelete.setVisibility(View.VISIBLE);

                holder.btndelete.setText("R");
                holder.btndelete.setPadding(10, 10, 10, 10);
                holder.btndelete.setTextSize(20);
                holder.btndelete.setTextColor(Color.WHITE);
                holder.btndelete.setBackgroundColor(mcontext.getResources().getColor(R.color.material_green_500));
            } if(dishorederlist.get(position).getStatus().equals("2")) {
                holder.btndelete.setVisibility(View.VISIBLE);
                holder.btndelete.setTextColor(Color.WHITE);
                holder.btndelete.setTextSize(20);
                holder.btndelete.setText("S");
                holder.btndelete.setPadding(10, 10, 10, 10);
                holder.btndelete.setBackgroundColor(mcontext.getResources().getColor(R.color.material_red_500));
            }
            holder.txtid.setText(dishorederlist.get(position).getDishid() + "");
            holder.txtdishname.setText(dishorederlist.get(position).getDishname() + "");
            holder.txtqty.setText(dishorederlist.get(position).getQty() + "");
        }

    }


    @Override
    public int getItemCount() {
        return dishorederlist.size();

    }
        // get Delete web service

   void getDeleteOrder(final int pos) {

       DeleteAPI mCommentsAPI = APIService.createService(DeleteAPI.class);
        mCommentsAPI.getUserPosts(actorderdetailid, new Callback<DeletePojo>() {

           @Override
           public void success(DeletePojo deletePojo, Response response) {
                M.hideLoadingDialog();
                Log.e("response", response.toString());

                if (deletePojo.getSuccess().equals("0")) {
                   Toast.makeText(mcontext, "Order Cancel", Toast.LENGTH_SHORT).show();
                    dishorederlist.remove(pos);
                    notifyItemChanged(pos);
                    notifyDataSetChanged();

                    //  finish();
               } else {
                    Toast.makeText(mcontext, "Can Not Cancel this Order", Toast.LENGTH_SHORT).show();
               }
            }

          @Override
            public void failure(RetrofitError error) {
                M.hideLoadingDialog();
                Log.e("error", error.getMessage());
            }
      });


    }
}